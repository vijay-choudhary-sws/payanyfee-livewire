<div>
    <div class="page-wrapper">
       <div class="page-content">
          <div class="card">
             <div class="card-body">
                <div class="ms-auto text-end">
                   <div class="row">
                      <div class="col-9">
                         <form wire:submit.prevent="searching">
                            <div class="page-breadcrumb d-none d-sm-flex align-items-center py-3">
                                <div class="px-2">
                                    <select wire:model="selectedUniversity" class="resizeselect filt1 form-control form-select" style="width:150px !important">
                                        <option value="">Course All</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->course_name }}" {{ $selectedUniversity == $course->course_name ? 'selected' : '' }}>
                                                {{ $course->course_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="px-2">
                                    <select wire:model="status" class="resizeselect filt2 form-control form-select" style="width:150px !important">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                               <div class="px-2">
                                  <input wire:model="searchs" type="search" class="form-control filt3" placeholder="Start typing to search">
                               </div>
                               <div class="px-2">
                                  <input class="btn btn-sm bg-primary text-white" type="submit" value="Apply">
                               </div>

                               <div class="px-2">
                                @if(!empty($searchs) || !empty($selectedUniversity) || !empty($selectedStatus))
                                    <button wire:click.prevent="clearFilters" type="button" class="btn btn-sm bg-info text-white">Clear</button>
                                @endif
                            </div>
                         </form>
                         </div>
                        </div>
                         <div class="col-3 text-end">
                            <div class="btn-group AddbtnPadding">
                               <a wire:navigate href="{{ route('admin.courses.coursecreate') }}"
                                  class="btn btn-primary mt-2 mt-lg-0 mb-">
                               Create {{ $heading }}
                               </a>
                            </div>
                         </div>
                   </div>
                </div>
             </div>
       </div>
             <div class="card">
                <div class="card-body">
                   <div class="row">
                      <div class="col-9"></div>
                      <div class="col-3">
                         {{-- <input type="text" class="form-control mb-2" placeholder="Search Title"
                            style="width: 188px;" wire:model.live="searchTerm"> --}}
                      </div>
                   </div>
                   <div class="table-responsive">
                      <table id="dataTable" class="table table-striped table-bordered">
                         <!-- Table headers -->
                         <thead>
                            <tr>
                               <th class="sort" wire:click="columnSortOrder('id')">S.No {!! $sortLink !!}</th>
                               <th class="sort" wire:click="columnSortOrder('course_name')">Course Name {!! $sortLink !!}
                               </th>
                               <th class="sort" wire:click="columnSortOrder('course_fee')">Course Fee {!! $sortLink !!}
                               </th>
                               <th class="sort" wire:click="columnSortOrder('total_sets')">Total Sets {!! $sortLink !!}
                               </th>
                               <th class="sort" wire:click="columnSortOrder('available_sets')">Available Sets {!! $sortLink !!}
                               </th>
                               <th class="sort" wire:click="columnSortOrder('status')">Status {!! $sortLink !!}
                               </th>
                               <th>Action</th>
                            </tr>
                         </thead>
                         <!-- Table body -->
                         <tbody>
                            @if ($courses->count())
                            @foreach ($courses as $course)
                            <tr>
                               <td>{{ $loop->iteration}}</td>
                               <td>{{ $course->course_name }} </td>
                               <td>{{ $course->course_fee }} </td>
                               <td>{{ $course->total_sets }} </td>
                               <td>{{ $course ->available_sets }} </td>
                               <td>
                                  <button style="font-size: 12px;" wire:click="status_update({{ $course->id }})" class="btn btn-info btn-sm" onclick="return confirm('Are you sure you want to change this course status?');">
                                  @if($course->status == 1) Inactive @else Active @endif
                                  </button>
                               </td>
                               <td>
                                  <a  href="{{ route('admin.courses.view', ['id' => $course->id]) }}">
                                  <i class="fa fa-eye"></i>
                                  </a>     
                                  <a style="font-size: 8px;padding-left: 5px; padding-right: 0px;" href="{{ route('admin.courses.courseedit', ['course' => $course]) }}"
                                     wire:navigate class="btn btn-secondary"
                                     title="Edit {{ $heading }}"><i class="bx bx-edit"></i></a>
                                  <button style="font-size: 8px;padding-left: 5px; padding-right: 0px;"  class="btn bg-red-500 text-white" type="button"
                                     wire:click="delete({{ $course }})"
                                     wire:confirm="Are you sure you want to delete this {{ $heading }}?">
                                  <i class="bx bx-trash"></i>
                                  </button>
                               </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                               <td colspan="3">No record found</td>
                            </tr>
                            @endif
                         </tbody>
                      </table>
                      <!-- Pagination navigation links -->
                      {{-- {{ $courses->links() }} --}}
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>