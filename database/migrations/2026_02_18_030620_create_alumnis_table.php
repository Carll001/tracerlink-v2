<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();

            // PERSONAL INFORMATION
            $table->string('student_number', 50);
            $table->string('first_name', 100);
            $table->string('middle_initial', 5)->nullable();
            $table->string('last_name', 100);
            $table->string('contact_number', 30);
            $table->string('sex', 20);
            $table->string('email', 150);
            $table->text('address');

            // ACADEMIC INFORMATION
            $table->string('program_taken', 150);
            $table->string('year_batch_graduated', 50);
            $table->string('further_studies', 50);

            // EMPLOYMENT INFORMATION
            $table->string('employment_status', 50); // Employed, Unemployed, No Answer
            $table->string('employment_sector', 80)->nullable(); // Government, Private, Self Employment
            $table->string('employment_classification', 100)->nullable(); // Local/Foreign/Self employed classification
            $table->string('company_name', 150)->nullable();
            $table->string('work_location', 150)->nullable();

            // NEW (EMPLOYMENT DETAILS)
            $table->string('position_nature_of_work', 150)->nullable(); // NEW
            $table->string('job_aligned_with_course', 20)->nullable(); // Yes, No, No Answer

            // FEEDBACK
            $table->unsignedTinyInteger('overall_rating'); // 1-5

            $table->timestamps();

            $table->index(['student_number', 'email']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
