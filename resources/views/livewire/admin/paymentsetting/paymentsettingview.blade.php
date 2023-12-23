<div>

   <div class="page-wrapper">
       <div class="page-content">
        <div class="">
           <div class="bg-white rounded-lg shadow-md">
               <div class="p-4">
                   <div class="projectHead">
                       <h5 class="mb-0">Payment Settings Detail</h5>
                   </div>
                   <div class="mt-4">
                       <div class="">
                           <div class="flex justify-between items-center">
                               <div class="w-1/2">
                                   <div class="text-xl">Payment Settings Info</div>
                                   <ul class="list-none mt-4">
                                       <li class="flex ">
                                           <span class="font-semibold">Payment Settings Title</span>
                                           <span style="padding: 0 0 0 50px;">{{ $paymentsettings->title }}</span>
                                       </li>
                                       <li class="flex">
                                           <span class="font-semibold">Payment Settings Email</span>
                                           <span style="padding: 0 0 0 50px;">{{ $paymentsettings->email }}</span>
                                       </li>
                                       <li class="flex">
                                           <span class="font-semibold">Payment Settings CC Email</span>
                                           <span style="padding: 0 0 0 50px;">{{ $paymentsettings->cc_email }}</span>
                                       </li>
                                       <li class="flex">
                                        <span class="font-semibold">Payment Settings BCC Email</span>
                                        <span style="padding: 0 0 0 50px;">{{ $paymentsettings->bcc_email }}</span>
                                    </li>
                                    <li class="flex">
                                        <span class="font-semibold">Status</span>
                                        @if($paymentsettings->status == 1)
                                            <span style="padding: 0 0 0 50px;">Active</span>
                                        @else
                                            <span style="padding: 0 0 0 50px;">Inactive</span>
                                        @endif
                                    </li>
                                   </ul>
                               </div>
                               {{-- <div class="w-1/2">
                                  <ul class="list-none mt-4">
                                       <li class="flex">
                                           <span class="font-semibold">Status</span>
                                           @if($paymentsettings->status == 1)
                                               <span style="padding: 0 0 0 50px;">Active</span>
                                           @else
                                               <span style="padding: 0 0 0 50px;">Inactive</span>
                                           @endif
                                       </li>
                                   </ul>
                               </div> --}}
                           </div>
                       </div>
       
                   </div>
               </div>
           </div>
       </div>
       </div>
   </div>
  </div>

