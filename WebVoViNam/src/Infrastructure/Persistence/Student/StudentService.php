<?php

/** DAL */ /** Service */

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Student;

use App\Domain\Judge\ctphieudiem;
use App\Domain\Student\ketquathi;
use App\Domain\Student\StudentRepository;
use App\Domain\Chitietketquathi;
use App\Domain\Capdai;
use App\Domain\Khoathi;
use App\Domain\Kythuat;
use App\Infrastructure\Persistence\Database\db;
use PDO;
use PDOException;

class StudentService implements StudentRepository
{
    private PDO $conn;
    //connect db
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
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