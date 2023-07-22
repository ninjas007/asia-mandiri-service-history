<div class="filter-section">
    <h5 class="mb-3">
        <i class="fa fa-search"></i> FILTER
    </h5>
    <div class="text-center bg-dark text-white my-1 border py-2" data-mdb-toggle="collapse" href="#collapseFilter"
        role="button" aria-expanded="false" aria-controls="collapseFilter">
        <b>SET FILTER</b>
    </div>

    <div class="row collapse pt-2" id="collapseFilter">
        <div class="col-md-6 mb-3">
            <label for="datepicker">Date Start:</label>
            <input type="date" id="dateEnd" class="form-control" placeholder="Select date">
        </div>
        <div class="col-md-6 mb-3">
            <label for="datepicker">Date End:</label>
            <input type="date" id="dateEnd" class="form-control" placeholder="Select date">
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
        <div class="col-md-12 mt-2">
            <button type="button" class="btn btn-warning float-end">Reset</button>
            <button type="button" class="btn btn-success mx-3 float-end">Filter</button>
        </div>
    </div>
</div>
<hr>