<?php

namespace App\Imports;

use App\Models\Subscription;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class SubscriptionsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Subscription([
            'user_id' => $row['user_id'],
            'profile_id' => $row['profile_id'] ?? null,
            'plan_id' => $row['plan_id'] ?? null,
            'plan_name' => $row['plan_name'],
            'plan_type' => $row['plan_type'],
            'amount' => $row['amount'],
            'currency' => $row['currency'] ?? 'INR',
            'billing_cycle' => $row['billing_cycle'],
            'starts_at' => isset($row['starts_at']) ? Carbon::parse($row['starts_at']) : now(),
            'ends_at' => isset($row['ends_at']) ? Carbon::parse($row['ends_at']) : null,
            'status' => $row['status'] ?? 'active',
            'payment_method' => $row['payment_method'] ?? null,
            'transaction_id' => $row['transaction_id'] ?? null,
            'is_auto_renew' => $row['is_auto_renew'] ?? true,
        ]);
    }
}