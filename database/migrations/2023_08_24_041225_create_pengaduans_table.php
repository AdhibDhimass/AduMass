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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id('id'); // Primary Key
            $table->timestamp('tgl_pengaduan');
            $table->text('judul');
            $table->text('isi_laporan');
            $table->string('foto')->nullable();
            $table->enum('status', ['0', 'proses', 'selesai']);
            $table->string('nik', 16); // Sesuaikan tipe data dengan yang ada di tabel 'users'
            $table->timestamps();

            // Tambahkan indeks pada kolom 'nik'
            $table->index('nik');

            // Definisikan kunci asing ke tabel 'users' dengan referensi kolom 'nik'
            $table->foreign('nik')->references('nik')->on('users');
        });
    }


        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('pengaduans');
        }
    };
