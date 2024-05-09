<?php
include_once __DIR__ . '/../Connection.php';
include_once __DIR__ . '/../Model/SponsorContractModel.php';

class SponsorContractController
{
    private $connection;

    public function __construct() {
        // Get the PDO connection from the static method
        $this->connection = Connection::getConnection();
    }

    public function getContractWithSponsor($contractId) {
        // SQL query to select the contract along with the sponsor details
        $sql = "SELECT sc.*, s.sponsor_name, s.sponsor_email, s.sponsor_phone, s.sponsor_address, s.sponsor_description, s.sponsor_website 
            FROM sponsor_contract sc
            JOIN sponsor s ON sc.sponsor_id = s.id
            WHERE sc.id = :contractId";

        // Prepare the SQL statement
        $stmt = $this->connection->prepare($sql);

        // Bind the contract ID parameter
        $stmt->bindValue(':contractId', $contractId, PDO::PARAM_INT);

        // Execute the statement
        $stmt->execute();

        // Fetch the result as an associative array
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function addContract(SponsorContractModel $contract) {
        // SQL query to insert a new sponsor contract
        $sql = "INSERT INTO sponsor_contract (
                    start_date,
                    end_date,
                    payement_method,
                    contract_status,
                    created_at,
                    updated_at,
                    sponsor_id ,
                    sponsor_pack_id 
                ) VALUES (
                    :start_date,
                    :end_date,
                    :payment_method,
                    :contract_status,
                    :created_at,
                    :updated_at,
                    :sponsor_id,
                    :sponsor_pack_id
                )";

        // Prepare the SQL statement
        $stmt = $this->connection->prepare($sql);

        // Bind the parameters from the SponsorContractModel object
        $stmt->bindValue(':start_date', $contract->getStartDate()->format('Y-m-d'), PDO::PARAM_STR);
        $stmt->bindValue(':end_date', $contract->getEndDate()->format('Y-m-d'), PDO::PARAM_STR);
        $stmt->bindValue(':payment_method', $contract->getPaymentMethod(), PDO::PARAM_STR);
        $stmt->bindValue(':contract_status', $contract->isContractStatus() ? 1 : 0, PDO::PARAM_INT);
        $stmt->bindValue(':created_at', $contract->getCreatedAt()->format('Y-m-d'), PDO::PARAM_STR);
        $stmt->bindValue(':updated_at', $contract->getUpdatedAt()->format('Y-m-d'), PDO::PARAM_STR);
        $stmt->bindValue(':sponsor_id', $contract->getSponsorId(), PDO::PARAM_INT);
        $stmt->bindValue(':sponsor_pack_id', $contract->getSponsorPackId(), PDO::PARAM_INT);

        // Execute the statement and return whether the execution was successful
        return $stmt->execute();
    }

    public function getAllContracts() {
        // SQL query to select all contracts with join on sponsor and sponsor_pack
        $sql = "SELECT sc.*, s.sponsor_name, s.sponsor_logo, sp.pack_name, sp.pack_description 
                FROM sponsor_contract sc
                JOIN sponsor s ON sc.sponsor_id = s.id
                LEFT JOIN sponsor_pack sp ON sc.sponsor_pack_id = sp.id";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $contracts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $contracts;
    }

    public function toggleContractStatus($contractId) {
        // SQL query to get the current status of the contract
        $sql = "SELECT contract_status FROM sponsor_contract WHERE id = :contractId";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':contractId', $contractId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if we got a result
        if ($result === false) {
            return false;  // Contract not found
        }
        $currentStatus = $result['contract_status'];
        $newStatus = $currentStatus ? 0 : 1;  // Toggle the status

        $updateSql = "UPDATE sponsor_contract SET contract_status = :newStatus WHERE id = :contractId";

        $updateStmt = $this->connection->prepare($updateSql);
        $updateStmt->bindValue(':newStatus', $newStatus, PDO::PARAM_INT);
        $updateStmt->bindValue(':contractId', $contractId, PDO::PARAM_INT);

        return $updateStmt->execute();
    }
}
