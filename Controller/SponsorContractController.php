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
}
