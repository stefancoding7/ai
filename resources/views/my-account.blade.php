@extends('layouts.app')

@section('content')
<style>
    #stacked-example-1 {
  height: 20px;
  max-width: 400px;
  margin: 0 auto;
  --heading-size: 2.5rem;
  --color-1: rgba(13, 202, 240, 0.6);
  --color-2: rgba(255, 193, 7, 0.6);
  --color-3: rgba(220,  53, 69, 0.6);
  overflow: hidden;
}
#stacked-example-1 caption {
  font-weight: bold;
}
</style>
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">

            <div class="col-md-8 col-xl-6 chat">
                <form action="{{route('my-account-post')}}" method="post">
                    @csrf
                    <div class="card" style="height: 100%">
                        <div class="card-header msg_head">
                            <p>My Account</p>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                {{Session::get('message')}}
                                </div>

                            @endif
                            <h3 class="text-center mb-5"  style="color:white;"><i class="bi bi-pie-chart-fill"></i> Usage</h3>
                            <table id="stacked-example-1" class="charts-css bar hide-data show-labels multiple stacked show-data-axes">
                                <tbody>
                                    <tr>
                                    <td style="--size: calc(350 / 100);"><span class="data"> 350 </span></td>
                                    <td style="--size: calc(250 / 100);"><span class="data"> 250 </span></td>
                                    <td style="--size: calc(5530 / 100);"><span class="data"> 5530 </span></td>
                                    </tr>
                                </tbody>
                                </table>
                                <div style="display:flex; justify-content: center; margin-top: 5px;">
                                <div style="height:15px; width:15px; background-color: rgba(13, 202, 240, 0.6); margin-right: 5px"></div>
                                <span class="text1" style="margin-right: 10px"> 350 </span>
                                <div style="height:15px; width:15px; background-color: rgba(255, 193, 7, 0.6); margin-right: 5px"></div>
                                <span class="text2" style="margin-right: 10px"> 250 </span>
                                <div style="height:15px; width:15px; background-color: rgba(220,  53, 69, 0.6); margin-right: 5px"></div>
                                <span class="text3"> 5530 </span>
                                </div>
                                <br> <br>
                            <div class="row">
                                
                               
                                <div class="col-md-4">
                                    <div class="text-center mb-5">
                                        <button type="button" class="btn btn-info position-relative" style="border-radius: 20px;">
                                        {{$gpt4TotalTokens}} tokens
                                            <br>
                                            ${{number_format($gpt4Price, 2)}}
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            GPT 4
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </button>
                                    </div>
                                    
                                    
                                </div>

                                <div class="col-md-4">
                                    <div class="text-center mb-5">
                                        <button type="button" class="btn btn-info position-relative" style="border-radius: 20px;">
                                            {{$gpt35TotalTokens}} tokens
                                            <br>
                                            ${{number_format($gpt35Price, 2)}}
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            GPT 3.5
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="text-center mb-5">
                                        <button type="button" class="btn btn-info position-relative" style="border-radius: 20px;">
                                            {{$createImageTotalTokens}} tokens
                                            <br>
                                            ${{number_format($imagePrice, 2)}}
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            Image Creation
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </button>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="text-center mb-5">
                                        <button type="button" class="btn btn-info position-relative" style="border-radius: 20px;">
                                            ${{number_format($gpt4Price + $gpt35Price + $imagePrice, 2)}}
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            Total
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </button>
                                    </div>
                                </div> --}}
                                   
                            </div>
                            
                            <hr>
                            <label>GPT API Key</label>
                            <input name="api_key" type="text" class="form-control" value="{{auth()->user()->api_key}}" autocomplete="off"> 
                            <br>
                            <label>Saver Mode</label>
                            <select name="saver_mode" class="form-control">
                                <option value="Extra Saver" {{auth()->user()->saver_mode == 'Extra Saver' ? 'selected' : ''}}>Extra Saver</option>
                                <option value="Saver" {{auth()->user()->saver_mode == 'Saver' ? 'selected' : ''}}>Saver</option>
                                <option value="No Saver" {{auth()->user()->saver_mode == 'No Saver' ? 'selected' : ''}}>No Saver</option>
                            </select>
                            <br>
                            <label>Image Resolution</label>
                            <select name="image_resolution" class="form-control">
                                <option value="256x256" {{auth()->user()->image_resolution == '256x256' ? 'selected' : ''}}>256x256px</option>
                                <option value="512×512" {{auth()->user()->image_resolution == '512×512' ? 'selected' : ''}}>512×512px</option>
                                <option value="1024×1024" {{auth()->user()->image_resolution == '1024×1024' ? 'selected' : ''}}>1024×1024px</option>
                            </select>
                            <br>
                            <p>Personalize your chat</p>
                            <div class="row">
                                <div class="col-4">
                                    
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="create_image" value="1" role="switch" id="CreateImage" {{auth()->user()->create_image == 1 ? 'checked' : ''}} autocomplete="off">
                                        <label class="form-check-label" for="CreateImage" >Create Image</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="gpt_3_5" value="1" role="switch" id="gpt_3_5" {{auth()->user()->gpt_3_5 == 1 ? 'checked' : ''}} autocomplete="off">
                                        <label class="form-check-label" for="gpt_3_5" >GPT 3.5</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="gpt_4" value="1" role="switch" id="gpt_4" {{auth()->user()->gpt_4 == 1 ? 'checked' : ''}} autocomplete="off">
                                        <label class="form-check-label" for="gpt_4" >GPT 4</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="create_website" value="1" role="switch" id="create_website" {{auth()->user()->create_website == 1 ? 'checked' : ''}} autocomplete="off">
                                        <label class="form-check-label" for="create_website" >Create Website</label>
                                    </div>
                                </div>
                            </div>
                            

                            <button class="btn btn-primary mt-3" type="submit" style="border-radius: 20px;">Update</button>
                        </div>
                        
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@endsection