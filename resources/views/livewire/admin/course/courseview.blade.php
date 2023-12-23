<div>

   <div class="page-wrapper">
       <div class="page-content">
        <div class="p-4">

           <div class="bg-white rounded-lg shadow-md">
               <div class="p-4">
                   <div class=" text-xl text-white font-bold  rounded-md">
                       <h5 class="mb-0">Course Detail</h5>
                   </div>
                   <div class="mt-4">
       
                       <div class="">
                           <div class="flex justify-between items-center">
                               <div class="w-1/2">
                                   <div class="text-xl font-bold">Course Info</div>
                                   <ul class="list-none mt-4">
                                       <li class="flex ">
                                           <span class="font-semibold">Course Name</span>
                                           <span style="padding: 0 0 0 50px;">{{ $course->course_name }}</span>
                                       </li>
                                       <li class="flex">
                                           <span class="font-semibold">Course Fee</span>
                                           <span style="padding: 0 0 0 50px;">{{ $course->course_fee }}</span>
                                       </li>
                                       <li class="flex">
                                           <span class="font-semibold">Total Sets</span>
                                           <span style="padding: 0 0 0 50px;">{{ $course->total_sets }}</span>
                                       </li>
                                   </ul>
                               </div>
                               <div class="w-1/2">
                                   <div class="text-xl font-bold">About</div>
                                   <ul class="list-none mt-4">
                                       <li class="flex">
                                           <span class="font-semibold">Available Sets</span>
                                           <span style="padding: 0 0 0 50px;">{{ $course->available_sets }}</span>
                                       </li>
                                       <li class="flex ">
                                           <span class="font-semibold">Description</span>
                                           <span style="padding: 0 0 0 50px;">{{ $course->description }}</span>
                                       </li>
                                       <li class="flex">
                                           <span class="font-semibold">Status</span>
                                           @if($course->status == 1)
                                               <span style="padding: 0 0 0 50px;">Active</span>
                                           @else
                                               <span style="padding: 0 0 0 50px;">Inactive</span>
                                           @endif
                                       </li>
                                   </ul>
                               </div>
                           </div>
                       </div>
       
                   </div>
               </div>
           </div>
       
       </div>
       
       </div>
   </div>
  </div>
