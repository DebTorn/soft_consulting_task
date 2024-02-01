
<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="fileModalLabel">Adatok importálása</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bezárás"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="/persons/import" enctype="multipart/form-data">
                @csrf

                <input type="file" name="xml_file" accept=".xml">

                <input type="submit" class="btn btn-success" value="Mentés">
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button>
        </div>
      </div>
    </div>
  </div>