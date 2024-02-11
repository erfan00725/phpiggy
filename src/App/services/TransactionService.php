<?php
declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class TransactionService
{
    public function __construct(private Database $db) 
    {
    }
    
    public function createTransaction(array $data)
    {
        $formatedDate = "{$data['date']} 00:00:00";

        $this->db->query(
            "INSERT INTO transactions (user_id, description, amount, date) VALUES (:user_id, :description, :amount, :date)", 
            [
                'user_id' => $_SESSION['user'],
                'description' => $data['description'],
                'amount' => $data['amount'],
                'date' => $formatedDate
            ]
            );
    }

    public function getUserTreansaction(int $lenght , int $offset){
        $searchTerm = addcslashes($_GET['s'] ?? '', "%_");

        $params = ['user_id' => $_SESSION['user'] , 'search' => "%{$searchTerm}%"];

        $transactions = $this->db->query("SELECT *, DATE_FORMAT(date , '%Y-%m-%d') as formated_date FROM transactions WHERE
         user_id = :user_id AND description LIKE :search LIMIT {$lenght} OFFSET {$offset}" , $params)->getAllData();

        $transactionCount = $this->db->query("SELECT COUNT(*) FROM transactions WHERE
         user_id = :user_id AND description LIKE :search" , $params)->count();


        return [$transactions, $transactionCount];
    }
}