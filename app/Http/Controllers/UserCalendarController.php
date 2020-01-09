<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Room;
use App\Photo;
use App\CustomClass\Calendar;
use App\CustomClass\Functions;

class UserCalendarController extends Controller
{
    public function session(Request $request)
    {
        session(Functions::unserialize_from_base64($request->booking));
    }

    public function checkavail(Request $request)
    {
        function testRange($s1,$e1,$s2,$e2)
        {
            return ($e1 < $s2 || $s1 > $e2);
        }
        
        $room_available = array();
        $rooms = Room::all('id', 'room_number', 'price', 'description');
        $output = '';

        foreach($rooms as $room)
        {
            $bookings = Booking::where('room_id', $room->id)->get();

            $room_available[$room->room_number] = $room;

            foreach ($bookings as $booking)
            {
                $room_available[$room->room_number] = $room;

                $s1 = strtotime($request->time_from);
                $e1 = strtotime($request->time_to);
                $s2 = strtotime($booking->time_from);
                $e2 = strtotime($booking->time_to);

                if(!testRange($s1, $e1, $s2, $e2))
                {
                    $room_available[$room->room_number] = 'Room not available';
                    break;
                }
            }
        }

        $count = 0;
        $html = '';
        $photos = '';
        $session = array();
        $html .= '<div class="row justify-content-center">';

        

        // if(is_object($photos))
        // {
        //     $photos = (object) array(0 => (object) array('url' => 'https://icingprint.co.uk/books/img/no.jpg'));
        // }

        // $photos = [ 'https://teighmore-assets.s3.amazonaws.com/media/filer_public_thumbnails/filer_public/f8/43/f8437568-8cd3-402f-87cd-27919c2d897f/rooms-and-suites-main-image.jpg__954x493_q85_crop_subsampling-2_upscale.jpg', 
        //             'https://www.marinabaysands.com/content/dam/singapore/marinabaysands/master/main/home/hotel/rooms-suites/premier-room/premiere%201_1920x960.jpg', 
        //             'https://q-cf.bstatic.com/images/hotel/max1024x768/166/166584457.jpg'];

        foreach($room_available as $key_rooms => $room_array)
        {
            if(is_object($room_array))
            {
                $photos = Photo::where('room_id', $room_array->id)->get();

                if($photos->isEmpty())
                {
                    $photos = (object) array(0 => (object) array('url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLJzaPoFd70YG1ZhdgHT_nNQX06h4XlOxyjEvy2KQy_aA8QbYo2w&s'));
                }

                $booking_days = Calendar::date_range($request->time_from, $request->time_to);
                $nights = count($booking_days) -1;
                $price = $nights * $room_array->price;

                $session = [
                    'room' => $room_array->room_number,
                    'time_from' => $request->time_from,
                    'time_to' => $request->time_to,
                    'nights' => $nights,
                    'price' => $price
                ];

                $session = Functions::serialize_to_base64($session);


                $html .= '
                    <div class="col-md-8 mt-4">
                        <div class="card">
                            <div class="card-header">Room '. $room_array->room_number .'</div>
                            <div class="card-body">
                                <div class="photos">';
                $html .= '
                                    <div id="room_'. $room_array->room_number .'" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">';
                $photo_count = 0;
                                        foreach($photos as $photo)
                                        {
                                            if($photo_count == 0)
                                            {
                                                $html .= '<li data-target="#room_'. $room_array->room_number .'" data-slide-to="'. $photo_count .'" class="active"></li>';
                                            }
                                            else
                                            {
                                                $html .= '<li data-target="#room_'. $room_array->room_number .'" data-slide-to="'. $photo_count .'"></li>';
                                            }
                                            $photo_count++;
                                        }
                
                $html .= '
                                        </ol>
                                    <div class="carousel-inner">';
                $photo_count = 0;
                                foreach($photos as $photo)
                                {
                                    if($photo_count == 0)
                                    {
                                        $html .= '
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="'. $photo->url .'" alt="Room '. $room_array->room_number .'">
                                        </div>';
                                    }
                                    else
                                    {
                                        $html .= '
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="'. $photo->url .'" alt="Room '. $room_array->room_number .'">
                                        </div>';
                                    }
                                    $photo_count++;
                                }
                $html .= '
                                    </div>
                                    <a class="carousel-control-prev" href="#room_'. $room_array->room_number .'" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#room_'. $room_array->room_number .'" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>';


                $html .= '
                            </div>
                                <div class="d-flex justify-content-center">
                                    <div class="m-4"><span class="main-price">&pound;'. $room_array->price .'</span> / <small>night</small></div>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <a href="'. route("make.reservation") .'">
                                        <button class="btn btn-primary session"
                                                data-booking = "'. $session .'"
                                            >Make reservation
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>';
                $count++;
            }
            else
            {
                continue;
            }
        }
            $html .= '</div>';

        if($count == 0)
        {
            $html = '
                <div class="row justify-content-center">
                    <div class="col-md-8 mt-4">
                        <div class="card">
                            <div class="card-header">Sorry</div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <p>We have no rooms available on selected dates</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

        return ($html);
    }
}
