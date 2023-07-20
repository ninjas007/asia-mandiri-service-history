<div class="filter-section">
    <h5 class="mb-3">FILTER</h5>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="datepicker">Date:</label>
            <input type="text" id="datepicker" class="form-control" placeholder="Select date">
        </div>
        <div class="col-md-6 mb-3">
            <label for="layanan">Layanan:</label>
            <select id="layanan" class="form-control">
                <option value="">Select Layanan</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->nama_layanan }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="client">Client:</label>
            <select id="client" class="form-control">
                <option value="">Select Client</option>
                <option value="1">Client X</option>
                <option value="2">Client Y</option>
                <option value="3">Client Z</option>
                {{-- Add more options here if needed --}}
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="teknisi">Teknisi:</label>
            <select id="teknisi" class="form-control">
                <option value="">Select Teknisi</option>
                <option value="1">John Doe</option>
                <option value="2">Jane Smith</option>
                <option value="3">David Lee</option>
                {{-- Add more options here if needed --}}
            </select>
        </div>
        <div class="col-md-6">
            <label for="status">Status:</label>
            <select id="status" class="form-control">
                <option value="">Select Status</option>
                <option value="1">PENGERJAAN</option>
                <option value="2">SELESAI</option>
                <option value="3">ON HOLD</option>
                {{-- Add more options here if needed --}}
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <button type="button" class="btn btn-warning mt-3">Reset</button>
            <button type="button" class="btn btn-success mt-3">Filter</button>
        </div>
    </div>
</div>