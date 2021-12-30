<?php 

namespace App\Models;
use CodeIgniter\Model;

class DeletedPlanModel extends Model
{
    protected $table = 'deleted_plans';
    // protected $primaryKey = 'plan_id';
    protected $protectFields = [];
    protected $allowedFields = [
      'plan_id',
      'deleted_at', // ASSINATURA ID
    ];
}