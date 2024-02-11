<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, TransactionService};

class TransactionController
{
  public function __construct(
    private TemplateEngine $view,
    private ValidatorService $validatorService,
    private TransactionService $transactionService
  ) {
  }

  public function createView()
  {
    echo $this->view->render("transactions/create.php");
  }

  public function create(){
    $this->validatorService->validateTransactions($_POST);

    $this->transactionService->createTransaction($_POST);

    redirectTo('/');  
  }

  public function editView(array $params){
    dd($params);
  }
}