<div class="sidebar-wrapper" data-simplebar="init">
   <div class="simplebar-wrapper" style="margin: 0px;">
      <div class="simplebar-height-auto-observer-wrapper">
         <div class="simplebar-height-auto-observer"></div>
      </div>
      <div class="simplebar-mask">
         <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
            <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
               <div class="simplebar-content mm-active" style="padding: 0px;">
                  <div class="sidebar-header">
                     <div>
                        <img src="{{ asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
                     </div>
                     <div>
                        <h4 class="logo-text">Rocker</h4>
                     </div>
                     <div class="toggle-icon ms-auto"><i class="bx bx-arrow-to-left"></i>
                     </div>
                  </div>
                  <!--navigation-->
                  <ul class="metismenu mm-show" id="menu">
                     <li>
                        <a href="{{route('admin.dashboard')}}" wire:navigate class="" aria-expanded="true">
                           <div class="parent-icon"><i class="bx bx-home-circle"></i>
                           </div>
                           <div class="menu-title">Dashboard</div>
                        </a>
                     </li>
                     <li>
                        <a href="javascript:;" class="has-arrow">
                           <div class="parent-icon"><i class="lni lni-graduation"></i>
                           </div>
                           <div class="menu-title">Master Menu Category</div>
                        </a>
                        <ul class="mm-collapse">
                           <li>
                              <a  href="{{route('admin.courses')}}" wire:navigate class="" aria-expanded="true">
                                 <div class="parent-icon"><i class="bx bx-category"></i>
                                 </div>
                                 <div class="menu-title">Courses</div>
                              </a>
                           </li>
                           <li>
                              <a  href="{{route('admin.payment-type-courses')}}" wire:navigate class="" aria-expanded="true">
                                 <div class="parent-icon"><i class="bx bx-category"></i>
                                 </div>
                                 <div class="menu-title">Payment Type Courses</div>
                              </a>
                           </li>
                           <li>
                              <a  href="{{route('admin.select-payment-course')}}" wire:navigate class="" aria-expanded="true">
                                 <div class="parent-icon"><i class="bx bx-category"></i>
                                 </div>
                                 <div class="menu-title">Select Payment Courses</div>
                              </a>
                           </li>
                           <li>
                              <a  href="{{route('admin.schools')}}" wire:navigate class="" aria-expanded="true">
                                 <div class="parent-icon"><i class="bx bx-category"></i>
                                 </div>
                                 <div class="menu-title">Schools</div>
                              </a>
                           </li>
                           <li>
                              <a  href="{{route('admin.school-programs')}}" wire:navigate class="" aria-expanded="true">
                                 <div class="parent-icon"><i class="bx bx-category"></i>
                                 </div>
                                 <div class="menu-title">School Programs</div>
                              </a>
                           </li>
                           <li>
                              <a  href="{{route('admin.school-program-type')}}" wire:navigate class="" aria-expanded="true">
                                 <div class="parent-icon"><i class="bx bx-category"></i>
                                 </div>
                                 <div class="menu-title">School Program Types</div>
                              </a>
                           </li>
                           <li>
                              <a  href="{{route('admin.student-registrations')}}" wire:navigate class="" aria-expanded="true">
                                 <div class="parent-icon"><i class="bx bx-category"></i>
                                 </div>
                                 <div class="menu-title">Student Registration Fee Types</div>
                              </a>
                           </li>
                           <li>
                              <a  href="{{route('admin.payment-type-confrence')}}" wire:navigate class="" aria-expanded="true">
                                 <div class="parent-icon"><i class="bx bx-category"></i>
                                 </div>
                                 <div class="menu-title">Payment Type Conference</div>
                              </a>
                           </li>
                           <li>
                              <a  href="{{route('admin.select-datas')}}" wire:navigate class="" aria-expanded="true">
                                 <div class="parent-icon"><i class="bx bx-category"></i>
                                 </div>
                                 <div class="menu-title">Add Select Field</div>
                              </a>
                           </li>
                           <li>
                              <a  href="{{route('admin.gsts')}}" wire:navigate class="" aria-expanded="true">
                                 <div class="parent-icon"><i class="bx bx-category"></i>
                                 </div>
                                 <div class="menu-title">Add Gst</div>
                              </a>
                           </li>
                        </ul>
                        
                     <li>
                        <a  href="{{ route('admin.paymentsettings')}}" wire:navigate class="" aria-expanded="true">
                           <div class="parent-icon"><i class="bx bx-category"></i>
                           </div>
                           <div class="menu-title">Payment Setting</div>
                        </a>
                     </li>
                        <li>
                           <a  href="{{route('admin.paymentgetways')}}" wire:navigate class="" aria-expanded="true">
                              <div class="parent-icon"><i class="bx bx-category"></i>
                              </div>
                              <div class="menu-title">Payment Get Ways</div>
                           </a>
                        </li>
                     </li>
                  </ul>
                  <!--end navigation-->
               </div>
            </div>
         </div>
      </div>
      <div class="simplebar-placeholder" style="width: auto; height: 1391px;"></div>
   </div>
   <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
      <div class="simplebar-scrollbar simplebar-visible" style="width: 0px; display: none;"></div>
   </div>
   <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
      <div class="simplebar-scrollbar simplebar-visible" style="height: 78px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
   </div>
</div>