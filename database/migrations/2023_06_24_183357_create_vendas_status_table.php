<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendas_status', function (Blueprint $table) {
            $table->id();

            $table->enum('status', ['approved', 'in_process', 'rejected'])->nullable();

            $table->enum('status_detail', [
                'accredited',
                'pending_contingency',
                'pending_review_manual',
                'cc_rejected_bad_filled_card_number	',
                'cc_rejected_bad_filled_date',
                'cc_rejected_bad_filled_other',
                'cc_rejected_bad_filled_security_code',
                'cc_rejected_blacklist',
                'cc_rejected_call_for_authorize',
                'cc_rejected_card_disabled',
                'cc_rejected_card_error',
                'cc_rejected_duplicated_payment',
                'cc_rejected_high_risk',
                'cc_rejected_insufficient_amount',
                'cc_rejected_invalid_installments',
                'cc_rejected_max_attempts',
                'cc_rejected_other_reason',
                'cc_rejected_card_type_not_allowed'
            ])->nullable();

            $table->string('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas_status');
    }
};
