<!-- Tambah Pertanyaan -->
<div class="modal" tabindex="-1" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Tambah Pertanyaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('pertanyaan.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="question">Pertanyaan</label>
                                <input type="text" name="question" id="question" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="answer_a">Jawaban A</label>
                                <input type="text" name="answer_a" id="answer_a" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="answer_b">Jawaban B</label>
                                <input type="text" name="answer_b" id="answer_b" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="answer_c">Jawaban C</label>
                                <input type="text" name="answer_c" id="answer_c" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="answer_d">Jawaban D</label>
                                <input type="text" name="answer_d" id="answer_d" class="form-control" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="correct">Jawaban Benar</label>
                                <select name="correct" id="correct" class="form-select">
                                    <option value="a">Jawaban A</option>
                                    <option value="b">Jawaban B</option>
                                    <option value="c">Jawaban C</option>
                                    <option value="d">Jawaban D</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">
                            <i class="bx bx-save"></i> Buat
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Kuis -->



<div class="modal" tabindex="-1" id="importExcel" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Import Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('pertanyaan.import')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
                        <div class="row">
                            <div class="col-7 mb-3">
                                <label for="question">Unduh Template</label>
                                <a style="text-decoration: underline;" href="{{asset('templates/template.xlsx')}}" download>Unduh</a>
                            </div>
                            <div class="col-7 mb-3">
                                <label for="question">Pilih file excel</label>
                                <input type="file" name="file" id="file" class="form-control" accept=".xls, .xlsx, .csv" required>
                            </div>
                          
                        </div>
                        <button class="btn btn-primary" type="submit">
                            <i class="bx bx-save"></i> Import
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>