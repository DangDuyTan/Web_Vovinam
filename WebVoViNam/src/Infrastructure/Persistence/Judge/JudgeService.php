<?php

/** DAL */ /** Service */

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Judge;

use App\Domain\Judge\ctphieudiem;
use App\Domain\Student\ketquathi;
use App\Domain\Judge\JudgeRepository;
use App\Domain\Chitietketquathi;
use App\Domain\Capdai;
use App\Domain\Khoathi;
use App\Domain\Kythuat;
use App\Infrastructure\Persistence\Database\db;
use PDO;
use PDOException;

class JudgeService implements JudgeRepository
{
    private PDO $conn;
    //connect db
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }
    function getListPDiem($khoaThi = '', $capDai = '', $phanThi = '')
    {
        $query = "SELECT 
                    ct.maCTPhieuDiem AS `maCTPhieuDiem`,  -- Thêm dòng này
                    ms.hoTen AS `hoTen`,
                    ms.maThe AS `maThe`,
                    kt.tenKhoaThi AS `tenKhoaThi`,
                    cd1.tenCapDai AS `tenCapDai`,
                    kt2.tenKyThuat AS `tenKyThuat`,
                    ct.ThuocBai AS `ThuocBai`,
                    ct.NhanhManh AS `NhanhManh`,
                    ct.TanPhap AS `TanPhap`,
                    ct.ThuyetPhuc AS `ThuyetPhuc`,
                    (ct.ThuocBai + ct.NhanhManh + ct.TanPhap + ct.ThuyetPhuc) AS `TongDiem`,
                    CASE 
                        WHEN ct.KetQua = 1 THEN 'Đạt'
                        ELSE 'Không đạt'
                    END AS `KetQua`,
                    ct.GhiChu AS `GhiChu`,
                    ct.NgayCham AS `NgayCham`
                FROM 
                    ctphieudiem ct
                LEFT JOIN 
                    chitietketquathi ctkq ON ct.maChiTietKetQua = ctkq.maChiTietKetQua
                LEFT JOIN 
                    monsinh ms ON ct.maMonSinh = ms.maMonSinh
                LEFT JOIN 
                    khoathi kt ON ct.maKhoaThi = kt.maKhoaThi
                LEFT JOIN 
                    capdai cd1 ON ct.maCapDai = cd1.maCapDai
                LEFT JOIN 
                    kythuat kt2 ON ct.maKyThuat = kt2.maKyThuat
                WHERE 
                    (:khoaThi = '' OR kt.maKhoaThi = :khoaThi) AND
                    (:capDai = '' OR cd1.maCapDai = :capDai) AND
                    (:phanThi = '' OR kt2.maKyThuat = :phanThi)
                ORDER BY 
                    ms.hoTen";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':khoaThi', $khoaThi);
        $stmt->bindParam(':capDai', $capDai);
        $stmt->bindParam(':phanThi', $phanThi);
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    


    function getSelect() {
        $queryKhoaThi = "SELECT maKhoaThi, tenKhoaThi FROM khoathi";
        $queryCapDai = "SELECT maCapDai, tenCapDai FROM capdai";
        $queryPhanThi = "SELECT maKyThuat, tenKyThuat FROM kythuat";

        $stmtKhoaThi = $this->conn->query($queryKhoaThi);
        $stmtCapDai = $this->conn->query($queryCapDai);
        $stmtPhanThi = $this->conn->query($queryPhanThi);

        return [
            'khoaThi' => $stmtKhoaThi->fetchAll(PDO::FETCH_ASSOC),
            'capDai' => $stmtCapDai->fetchAll(PDO::FETCH_ASSOC),
            'phanThi' => $stmtPhanThi->fetchAll(PDO::FETCH_ASSOC)
        ];
    }

    function updateScore($maCTPhieuDiem, $ThuocBai, $NhanhManh, $TanPhap, $ThuyetPhuc, $GhiChu) {
        $Diem = $ThuocBai + $NhanhManh + $TanPhap + $ThuyetPhuc;
        $query = "UPDATE ctphieudiem 
                  SET 
                      ThuocBai = :ThuocBai, 
                      NhanhManh = :NhanhManh, 
                      TanPhap = :TanPhap, 
                      ThuyetPhuc = :ThuyetPhuc, 
                      GhiChu = :GhiChu,
                      Diem = :Diem,
                      KetQua = CASE 
                                  WHEN :Diem >= 5 THEN 1
                                  ELSE 0
                              END
                  WHERE maCTPhieuDiem = :maCTPhieuDiem";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':maCTPhieuDiem', $maCTPhieuDiem);
        $stmt->bindParam(':ThuocBai', $ThuocBai);
        $stmt->bindParam(':NhanhManh', $NhanhManh);
        $stmt->bindParam(':TanPhap', $TanPhap);
        $stmt->bindParam(':ThuyetPhuc', $ThuyetPhuc);
        $stmt->bindParam(':GhiChu', $GhiChu);
        $stmt->bindParam(':Diem', $Diem);
    
        $result = $stmt->execute();
        return $result;
    }
    
    
    function DanhSachKQ($khoaThi = '', $capDai = '') {
        $query = "SELECT 
                        ctkt.maChiTietKetQua AS maChiTietKetQua,  -- Thêm dòng này
                        ms.hoTen,
                        ms.maThe,
                        kt.tenKhoaThi,
                        cd.tenCapDai,
                        SUM(ctpd.Diem) AS TongDiem,
                        ctkt.ghiChu AS GhiChu,
                        CASE ctkt.ketQua
                            WHEN 1 THEN 'Đạt'
                            ELSE 'Không đạt'
                        END AS KetQua,
                        ctpd.GiamKhaoCham,
                        MAX(ctpd.ngayCham) AS NgayCham
                    FROM chitietketquathi ctkt

                    JOIN CTPhieuDiem ctpd ON ctkt.maChiTietKetQua = ctpd.maChiTietKetQua
                    JOIN monsinh ms ON ms.maMonSinh = ctpd.maMonSinh
                    JOIN khoathi kt ON ctpd.maKhoaThi = kt.maKhoaThi
                    JOIN capdai cd ON ctpd.maCapDai = cd.maCapDai
                    WHERE 
                        (:khoaThi = '' OR kt.maKhoaThi = :khoaThi) AND
                        (:capDai = '' OR cd.maCapDai = :capDai)
                        
                    GROUP BY ctpd.maChiTietKetQua, ms.hoTen, ms.maThe, kt.tenKhoaThi, cd.tenCapDai, ctkt.ketQua, ctpd.GiamKhaoCham
                    ORDER BY ms.hoTen, ms.maThe;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':khoaThi', $khoaThi);
        $stmt->bindParam(':capDai', $capDai);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchDSKQ($keyword)
    {
        $query = "SELECT 
                    ctkt.maChiTietKetQua,  -- Thêm dòng này
                    ms.hoTen,
                    ms.maThe,
                    kt.tenKhoaThi,
                    cd.tenCapDai,
                    ctkt.TongDiem,
                    ctkt.ghiChu,
                    CASE ctkt.ketQua
                        WHEN 1 THEN 'Đạt'
                        ELSE 'Không đạt'
                    END AS KetQua,
                    ctpd.GiamKhaoCham,
                    MAX(ctpd.ngayCham) AS NgayCham
                  FROM chitietketquathi ctkt

                    JOIN CTPhieuDiem ctpd ON ctkt.maChiTietKetQua = ctpd.maChiTietKetQua
                    JOIN monsinh ms ON ms.maMonSinh = ctpd.maMonSinh
                    JOIN khoathi kt ON ctpd.maKhoaThi = kt.maKhoaThi
                    JOIN capdai cd ON ctpd.maCapDai = cd.maCapDai
                  
                  WHERE ms.hoTen LIKE :keyword OR 
                        ms.maThe LIKE :keyword OR 
                        kt.tenKhoaThi LIKE :keyword OR 
                        cd.tenCapDai LIKE :keyword
                GROUP BY ctkt.maChiTietKetQua"; // Thêm GROUP BY để tránh lỗi khi dùng MAX()

        $stmt = $this->conn->prepare($query);
        $searchKeyword = '%' . $keyword . '%';
        $stmt->bindParam(':keyword', $searchKeyword);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function ListCTKQ($maChiTietKetQua) {
        // Lấy thông tin chi tiết từ database
        $sql = "SELECT  ctpd.maChiTietKetQua,
                        ctpd.maCTPhieuDiem,
                        ms.hoTen, 
                        ms.maThe, 
                        kt.tenKhoaThi, 
                        cd.tenCapDai,
                        kt1.tenKyThuat,
                        ctpd.ThuocBai,
                        ctpd.NhanhManh,
                        ctpd.TanPhap,
                        ctpd.ThuyetPhuc,
                        (ctpd.ThuocBai + 
                         ctpd.NhanhManh + 
                         ctpd.TanPhap + ctpd.ThuyetPhuc) AS `TongDiem`,
                        CASE 
                            WHEN ctpd.ketQua = 1 THEN 'Đạt'
                            ELSE 'Không đạt'
                        END AS `KetQua`,
                        ctpd.ghiChu,
                        ctpd.GiamKhaoCham
                FROM ctphieudiem ctpd
                JOIN chitietketquathi ctk ON ctk.maChiTietKetQua = ctpd.maChiTietKetQua
                JOIN monsinh ms ON ms.maMonSinh = ctpd.maMonSinh
                JOIN khoathi kt ON ctpd.maKhoaThi = kt.maKhoaThi
                JOIN capdai cd ON ctpd.maCapDai = cd.maCapDai
                JOIN kyThuat kt1 ON ctpd.maKyThuat = kt1.maKyThuat
                WHERE ctpd.maChiTietKetQua = :maChiTietKetQua
                ORDER BY ctpd.maChiTietKetQua, ctpd.maCTPhieuDiem";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':maChiTietKetQua', $maChiTietKetQua);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Kiểm tra nếu không có kết quả nào
        if (!$results) {
            return []; // hoặc return null; tùy thuộc vào cách bạn muốn xử lý không có dữ liệu
        }
    
        // Xây dựng cấu trúc JSON
        $response = [];
        foreach ($results as $row) {
            $maChiTietKetQua = $row['maChiTietKetQua'];
            
            if (!isset($response[$maChiTietKetQua])) {
                $response[$maChiTietKetQua] = [
                    'maChiTietKetQua' => $maChiTietKetQua,
                    'hoTen' => $row['hoTen'],
                    'maThe' => $row['maThe'],
                    'tenKhoaThi' => $row['tenKhoaThi'],
                    'tenCapDai' => $row['tenCapDai'],
                    'details' => []
                ];
            }
    
            $details = [
                'maCTPhieuDiem' => $row['maCTPhieuDiem'],
                'tenKyThuat' => $row['tenKyThuat'],
                'thuocBai' => $row['ThuocBai'],
                'nhanhManh' => $row['NhanhManh'],
                'tanPhap' => $row['TanPhap'],
                'thuyetPhuc' => $row['ThuyetPhuc'],
                'diem' => $row['TongDiem'],
                'ketQua' => $row['KetQua'],
                'giamKhaoCham' => $row['GiamKhaoCham'],
                'ghiChu' => $row['ghiChu']
            ];
    
            $response[$maChiTietKetQua]['details'][] = $details;
        }
    
        return array_values($response);
    }
    
}