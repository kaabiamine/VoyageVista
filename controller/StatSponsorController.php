
<?php
include_once __DIR__ . '/../Connection.php';
class StatSponsorController
{
    public static function getTotalContractsBySponsor() {
        $pdo = Connection::getConnection();
        $sql = "SELECT sponsor.sponsor_name, COUNT(sponsor_contract.id) AS total_contracts
            FROM sponsor
            LEFT JOIN sponsor_contract ON sponsor.id = sponsor_contract.sponsor_id
            GROUP BY sponsor.id, sponsor.sponsor_name";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting total contracts by sponsor: " . $e->getMessage());
            return [];
        }
    }

    public static function getTotalRevenueBySponsor() {
        $pdo = Connection::getConnection();
        $sql = "SELECT sponsor.sponsor_name, SUM(sponsor_pack.pack_price) AS total_revenue
            FROM sponsor
            JOIN sponsor_contract ON sponsor.id = sponsor_contract.sponsor_id
            JOIN sponsor_pack ON sponsor_contract.sponsor_pack_id = sponsor_pack.id
            WHERE sponsor_contract.contract_status = 1
            GROUP BY sponsor.id, sponsor.sponsor_name";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting total revenue by sponsor: " . $e->getMessage());
            return [];
        }
    }

    public static function getContractsOverview() {
        $pdo = Connection::getConnection();
        $sql = "SELECT sponsor.sponsor_name,
                   COUNT(CASE WHEN sponsor_contract.contract_status = 1 THEN 1 END) AS active_contracts,
                   COUNT(CASE WHEN sponsor_contract.contract_status = 0 THEN 1 END) AS expired_contracts
            FROM sponsor
            JOIN sponsor_contract ON sponsor.id = sponsor_contract.sponsor_id
            GROUP BY sponsor.id, sponsor.sponsor_name";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting contracts overview: " . $e->getMessage());
            return [];
        }
    }


    public static function getAverageContractDurationBySponsor() {
        $pdo = Connection::getConnection();
        $sql = "SELECT sponsor.sponsor_name, AVG(DATEDIFF(sponsor_contract.end_date, sponsor_contract.start_date)) AS avg_duration
            FROM sponsor
            JOIN sponsor_contract ON sponsor.id = sponsor_contract.sponsor_id
            GROUP BY sponsor.id, sponsor.sponsor_name";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting average contract duration by sponsor: " . $e->getMessage());
            return [];
        }
    }

    public static function getContractsByStatus($status) {
        $pdo = Connection::getConnection();
        $sql = "SELECT sponsor_contract.id, sponsor.sponsor_name, sponsor_contract.start_date, sponsor_contract.end_date, sponsor_contract.payement_method
            FROM sponsor_contract
            JOIN sponsor ON sponsor.id = sponsor_contract.sponsor_id
            WHERE sponsor_contract.contract_status = :status";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting contracts by status: " . $e->getMessage());
            return [];
        }
    }




}