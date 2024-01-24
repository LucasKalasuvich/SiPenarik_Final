@extends('layouts.app')
@section('title', 'Comment')
@section('heading', 'Comment')
@section('content')
<div class="container mt-5">

            <div class="row  d-flex justify-content-center">
                
                <div class="col-xl-9">
                    <h5 class="mb-3">Unread comments(6)</h5>
                        <div class="buttons">
                            
                            <span class="badge d-flex justify-content-end mb-3">
                                <span class="text-primary mt-2">Comments "ON"</span>
                                <div class="form-check form-switch">
                                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                  
                                </div>
                            </span>
                            
                        </div>

                    <div class="card p-3">

                        <div class="d-flex justify-content-between align-items-center">

                      <div class="user d-flex flex-row align-items-center">

                        <img src="https://i.imgur.com/hczKIze.jpg" width="30" class="user-img rounded-circle mr-2">
                        <span><small class="font-weight-bold text-primary">james_olesenn</small> <small class="font-weight-bold">Hmm, This poster looks cool</small></span>
                          
                      </div>


                      <small>2 days ago</small>

                      </div>


                      <div class="action d-flex justify-content-between mt-2 align-items-center">

                        <div class="reply px-4">
                            <small>Remove</small>
                            <span class="dots"></span>
                            <small>Reply</small>
                            <span class="dots"></span>
                            <small>Translate</small>
                           
                        </div>

                        <div class="icons align-items-center">

                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-check-circle-o check-icon"></i>
                            
                        </div>
                          
                      </div>


                        
                    </div>







                    <div class="card p-3 mt-2">

                        <div class="d-flex justify-content-between align-items-center">

                      <div class="user d-flex flex-row align-items-center">

                        <img src="https://i.imgur.com/C4egmYM.jpg" width="30" class="user-img rounded-circle mr-2">
                        <span><small class="font-weight-bold text-primary">olan_sams</small> <small class="font-weight-bold">Loving your work and profile! </small></span>
                          
                      </div>


                      <small>3 days ago</small>

                      </div>


                      <div class="action d-flex justify-content-between mt-2 align-items-center">

                        <div class="reply px-4">
                            <small>Remove</small>
                            <span class="dots"></span>
                            <small>Reply</small>
                            <span class="dots"></span>
                            <small>Translate</small>
                           
                        </div>

                        <div class="icons align-items-center">
                            <i class="fa fa-check-circle-o check-icon text-primary"></i>
                            
                        </div>
                          
                      </div>


                        
                    </div>










                    <div class="card p-3 mt-2">

                        <div class="d-flex justify-content-between align-items-center">

                      <div class="user d-flex flex-row align-items-center">

                        <img src="https://i.imgur.com/0LKZQYM.jpg" width="30" class="user-img rounded-circle mr-2">
                        <span><small class="font-weight-bold text-primary">rashida_jones</small> <small class="font-weight-bold">Really cool Which filter are you using? </small></span>
                          
                      </div>


                      <small>3 days ago</small>

                      </div>


                      <div class="action d-flex justify-content-between mt-2 align-items-center">

                        <div class="reply px-4">
                            <small>Remove</small>
                            <span class="dots"></span>
                            <small>Reply</small>
                            <span class="dots"></span>
                            <small>Translate</small>
                           
                        </div>

                        <div class="icons align-items-center">
                            <i class="fa fa-user-plus text-muted"></i>
                            <i class="fa fa-star-o text-muted"></i>
                            <i class="fa fa-check-circle-o check-icon text-primary"></i>
                            
                        </div>
                          
                      </div>


                        
                    </div>






                    <div class="card p-3 mt-2">

                        <div class="d-flex justify-content-between align-items-center">

                      <div class="user d-flex flex-row align-items-center">

                        <img src="https://i.imgur.com/ZSkeqnd.jpg" width="30" class="user-img rounded-circle mr-2">
                        <span><small class="font-weight-bold text-primary">simona_rnasi</small> <small class="font-weight-bold text-primary">@macky_lones</small> <small class="font-weight-bold text-primary">@rashida_jones</small> <small class="font-weight-bold">Thanks </small></span>
                          
                      </div>


                      <small>3 days ago</small>

                      </div>


                      <div class="action d-flex justify-content-between mt-2 align-items-center">

                        <div class="reply px-4">
                            <small>Remove</small>
                            <span class="dots"></span>
                            <small>Reply</small>
                            <span class="dots"></span>
                            <small>Translate</small>
                           
                        </div>

                        <div class="icons align-items-center">
                           
                            <i class="fa fa-check-circle-o check-icon text-primary"></i>
                            
                        </div>
                          
                      </div>


                        
                    </div>


                    
                </div>
                
            </div>
            
        </div>
@endsection
@section('script')
  <script>
    AOS.init();
  </script>
@endsection
