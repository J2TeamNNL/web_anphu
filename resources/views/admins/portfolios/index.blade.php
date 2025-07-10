   <div class="col-md-12">
      <div class="card card-plain">
         <div class="card-header">
               {{-- <p class="category"></p> --}}
               <p><a href="{{ route('portfolios.create')}}">Add more projects</a></p>
               
         </div>
         <div class="card-header">
               <form class="navbar-form navbar-left navbar-search-form" role="search">
                  {{-- Search key for pagination --}}
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-search"></i></span>
                  {{-- <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Search..."> --}}
                  </div>
               </form>
         </div>
         <div class="card-content table-responsive table-full-width">
               <table class="table table-hover" width="100%" border="1">
                  <tr>
                     <th>#</th>
                     <th>Project name</th>
                     <th>Location</th>
                     <th>Client</th>
                     <th>Image</th>
                     <th>Description</th>
                     <th>Year</th>
                     <th>Type</th>
                     <th>Category</th>
                     <th></th>
                     <th></th>
                  </tr>
                  @foreach($portfolios as $portfolio)
                     <tr>
                        <td>{{ $portfolio->id }}</td>
                        <td>{{ $portfolio->name }}</td>
                        <td>{{ $portfolio->location }}</td>
                        <td>{{ $portfolio->client }}</td>
                        <td>
                           @if ($portfolio->image)
                              <img src="{{ asset("storage/{$portfolio->image}") }}" alt="{{ $portfolio->name }}" width="100">
                           @else
                              NA
                           @endif
                        </td>
                        <td>{{ $portfolio->description }}</td>
                        <td>{{ $portfolio->year }}</td>
                        <td>{{ $portfolio->type }}</td>
                        <td>{{ $portfolio->category }}</td>
                        
                        <td>
                           <a href="{{ route('portfolios.edit', $portfolio)}}">
                              <button class="btn btn-primary">Edit</button>
                           </a>
                        </td>

                        <td>
                           <form method="post" action="{{ route('portfolios.destroy', $portfolio)}}">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger">Del</button>
                           </form>
                        </td>

                        {{-- @if(session()->get('level') == 1)
                        <td>
                           <form method="post" action="{{ route('portfolios.destroy', $portfolio)}}">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger">Del</button>
                           </form>
                        </td>
                        @endif --}}
                     </tr>
                  @endforeach
               </table>
         </div>
         {{-- <div class="float-left pagination-container">
               <ul class="pagination">
                  {{$data->links()}}
               </ul>
         </div> --}}
      </div>
   </div>