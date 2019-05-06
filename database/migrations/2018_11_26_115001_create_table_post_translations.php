<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePostTranslations extends Migration
{
	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up() {
		Schema::create('post_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('post_id')->default(0)->unsigned();
			$table->string('title', 300);
			$table->string('overview', 1000)->nullable();
			$table->text('content')->nullable();
			$table->string('seo_title', 500)->nullable();
			$table->string('seo_keyword', 500)->nullable();
			$table->text('seo_description')->nullable();
			$table->timestamps();
			$table->string('locale')->index();

			$table->unique(['post_id', 'locale']);
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('post_translations');
	}
}
