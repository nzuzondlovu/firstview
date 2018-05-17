@include('includes.header')

<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Table Example</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Logo</th>
                  <th>Website</th>
                  <th>Assets</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Logo</th>
                  <th>Website</th>
                  <th>Assets</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
              	@if(count($companies) > 0)
              		@foreach($companies->all() as $company)
		                <tr>
		                  <td>{{ $company->name }}</td>
		                  <td>{{ $company->email }}</td>
		                  <td><img class="img img-responsive" src="{{ url('$company->logo') }}"></td>
		                  <td><a href="http://{{ $company->website }}">{{ $company->website }}</a></td>
		                  <td>{{ $company->logo }}</td>
		                  <td><a class="btn btn-info" href="company">View</a></td>
		                </tr>
                	@endforeach
              	@endif
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>

@include('includes.footer')