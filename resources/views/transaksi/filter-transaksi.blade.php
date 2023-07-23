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
            <input type="date" id="dateStart" class="form-control" placeholder="Select date" value="{{ $filter['date_start'] ?? '' }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="datepicker">Date End:</label>
            <input type="date" id="dateEnd" class="form-control" placeholder="Select date" value="{{ $filter['date_end'] ?? '' }}">
        </div>
        <div class="col-md-6 mb-3 form-grop">
            <label for="layanan">Layanan:</label>
            <select id="layanan" class="form-control js-select2" style="width: 100%">
                <option value="">Semua Layanan</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ ($filter['layanan'] ?? '') == $service->id ? 'selected' : '' }}>{{ $service->nama_layanan }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="client">Client:</label>
            <select id="client" class="form-control js-select2" style="width: 100%">
                <option value="">Semua Client</option>
                @foreach ($list_client as $client)
                    <option value="{{ $client->id }}" {{ ($filter['client'] ?? '') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="teknisi">Teknisi:</label>
            <select id="teknisi" class="form-control js-select2" style="width: 100%">
                <option value="">Semua Teknisi</option>
                @foreach ($list_teknisi as $teknisi)
                    <option value="{{ $teknisi->id }}" {{ ($filter['teknisi'] ?? '') == $teknisi->id ? 'selected' : '' }}>{{ $teknisi->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="status">Status:</label>
            <select id="status" class="form-control js-select2" style="width: 100%">
                <option value="">Semua Status</option>
                @foreach ($list_status as $status)
                    <option value="{{ $status->id }}" {{ ($filter['status'] ?? '') == $status->id ? 'selected' : '' }}>{{ $status->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12 mt-2">
            <button type="button" class="btn btn-success float-end" id="filter-transaksi">
                <i class="fa fa-search"></i> Filter
            </button>
            <button type="button" class="btn btn-warning mx-3 float-end" id="filter-reset">
                <i class="fa fa-refresh"></i> Reset
            </button>
        </div>
    </div>
</div>
<hr>