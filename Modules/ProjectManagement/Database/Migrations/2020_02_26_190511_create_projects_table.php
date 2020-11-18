<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lead_contract_id');

            $table->unsignedInteger('designer_id')->nullable();
            $table->unsignedInteger('designer_deadline')->nullable();
            $table->timestamp('designer_activated_at')->nullable();
            $table->timestamp('designer_accepted_at')->nullable();
            $table->unsignedInteger('designer_progress')->default(0);
            $table->timestamp('designer_done_at')->nullable();

            $table->unsignedInteger('marketer_id')->nullable();
            $table->unsignedInteger('marketer_deadline')->nullable();
            $table->timestamp('marketer_activated_at')->nullable();
            $table->timestamp('marketer_accepted_at')->nullable();
            $table->unsignedInteger('marketer_progress')->default(0);
            $table->timestamp('marketer_done_at')->nullable();

            $table->unsignedInteger('advertiser_id')->nullable();
            $table->unsignedInteger('advertiser_deadline')->nullable();
            $table->timestamp('advertiser_activated_at')->nullable();
            $table->timestamp('advertiser_accepted_at')->nullable();
            $table->unsignedInteger('advertiser_progress')->default(0);
            $table->timestamp('advertiser_done_at')->nullable();

            $table->unsignedInteger('project_progress')->default(0);
            $table->timestamp('project_done_at')->nullable();

            $table->text('addresses')->nullable();
            $table->text('phone_numbers')->nullable();
            $table->text('websites')->nullable();
            $table->text('emails')->nullable();

            $table->unsignedInteger('designs_count')->nullable();
            $table->boolean('need_logo')->nullable();
            $table->string('logo_src')->nullable();
            $table->boolean('need_cover')->nullable();
            $table->boolean('need_profile')->nullable();
            $table->mediumText('colors_favorite')->nullable(); // [{"color": ""}]
            $table->mediumText('design_info')->nullable();
            $table->longText('gallery')->nullable();

            $table->text('posts_type')->nullable(); // {"single": 40, "grouped": 50, "cover_post": 20}
            $table->unsignedInteger('posts_count')->nullable();
            $table->mediumText('client_products')->nullable();
            $table->mediumText('client_offers')->nullable();
            $table->mediumText('competitors_links')->nullable(); // [{"url": "https://facebook.com/testaccount", "note": ""}]

            $table->unsignedInteger('sponsored_posts_count')->nullable();
            $table->mediumText('sponsored_posts_url')->nullable(); // [{"url": "", "done": false}]
            $table->mediumText('targeted_places')->nullable(); // [{"place": "القاهرة"}, {"place": "مدينة نصر"}]
            $table->text('targeted_gender')->nullable(); // {"male": false, "female": false}
            $table->text('targeted_age')->nullable(); // {"min": 13, "max": 65}
            $table->unsignedInteger('days_count')->nullable();
            $table->unsignedInteger('day_budget')->nullable();
            $table->text('note')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
