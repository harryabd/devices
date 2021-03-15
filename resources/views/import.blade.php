<p>{{ session('status') }}</p>

<form method="POST" action="{{ url("import") }}" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="file">CSV file to import</label>
        <input id="file" type="file" name="file" required>
    </div>

    <p><button type="submit" class="btn btn-success" name="submit"><i class="fa fa-check"></i> Submit</button></p>

</form>