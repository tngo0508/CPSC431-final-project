<?php
class PlayerStatistic
{
   // Instance attributes
   private $name         = array('FIRST'=>"", 'LAST'=>null);
   private $playingTime  = array('MINS' =>0,  'SECS'=>0);
   private $pointsScored = 0;
   private $assists      = 0;
   private $rebounds     = 0;
   private $gameid = 0;
   private $three_points = 0;
   private $fta = 0;
   private $steal = 0;

   private $foul = 0;
   private $block = 0;
   private $ftm  = 0;

   function name()
   {
     // string name()
     if( func_num_args() == 0 )
     {
       if( empty($this->name['FIRST']) ) return $this->name['LAST'];
       else                              return $this->name['LAST'].', '.$this->name['FIRST'];
     }

     // void name($value)
     else if( func_num_args() == 1 )
     {
       $value = func_get_arg(0);

       if( is_string($value) )
       {
         $value = explode(',', $value); // convert string to array

         if ( count($value) >= 2 ) $this->name['FIRST'] = htmlspecialchars(trim($value[1]));
         else                      $this->name['FIRST'] = '';

         $this->name['LAST']  = htmlspecialchars(trim($value[0]));
       }

       else if( is_array ($value) )
       {
         if ( count($value) >= 2 ) $this->name['LAST'] = htmlspecialchars(trim($value[1]));
         else                      $this->name['LAST'] = '';

         $this->name['FIRST']  = htmlspecialchars(trim($value[0]));
       }
     }

     // void name($first_name, $last_name)
     else if( func_num_args() == 2 )
     {
         $this->name['FIRST'] = htmlspecialchars(trim(func_get_arg(0)));
         $this->name['LAST']  = htmlspecialchars(trim(func_get_arg(1)));
     }

     return $this;
   }








   // playingTime() prototypes:
   //   string playingTime()                          returns playing time in "minutes:seconds" format.
   //
   //   void playingTime(string $value)               set object's $playingTime attribute
   //                                                 in "minutes:seconds" format.
   //
   //   void playingTime(array $value)                set object's $playingTime attribute
   //                                                 in [minutes, seconds] format
   //
   //   void playingTime(int $minutes, int $seconds)  set object's $playingTime attribute
   function playingTime()
   {
     // string playingTime()
     if( func_num_args() == 0 )
     {
       return $this->playingTime['MINS'].':'.$this->playingTime['SECS'];
     }

     // void playingTime($value)
     else if( func_num_args() == 1 )
     {
       $value = func_get_arg(0);

       if( is_string($value) ) $value = explode(':', $value); // convert string to array
       if( is_array ($value) )
       {
         if ( count($value) >= 2 ) $this->playingTime['SECS'] = (int)$value[1];
         else                      $this->playingTime['SECS'] = 0;
         $this->playingTime['MINS'] = (int)$value[0];
       }
     }

     // void playingTime($first_name, $last_name)
     else if( func_num_args() == 2 )
     {
       $this->playingTime['MINS'] = (int)func_get_arg(0);
       $this->playingTime['SECS'] = (int)func_get_arg(1);
     }

     return $this;
   }








   // pointsScored() prototypes:
   //   int pointsScored()               returns the number of points scored.
   //
   //   void pointsScored(int $value)    set object's $pointsScored attribute
   function pointsScored()
   {
     // int pointsScored()
     if( func_num_args() == 0 )
     {
       return $this->pointsScored;
     }

     // void pointsScored($value)
     else if( func_num_args() == 1 )
     {
       $this->pointsScored = (int)func_get_arg(0);
     }

     return $this;
   }



   function gameid()
   {
     // int pointsScored()
     if( func_num_args() == 0 )
     {
       return $this->gameid;
     }

     // void pointsScored($value)
     else if( func_num_args() == 1 )
     {
       $this->gameid = (int)func_get_arg(0);
     }

     return $this;
   }

   function three_points()
   {
     if( func_num_args() == 0 )
     {
       return $this->three_points;
     }

     else if( func_num_args() == 1 )
     {
       $this->three_points=(int)func_get_arg(0);
     }

     return $this;
   }



   function fta()
   {
     if( func_num_args() == 0 )
     {
       return $this->fta;
     }

     else if( func_num_args() == 1 )
     {
     $this->fta =(int)func_get_arg(0);
     }

     return $this;
   }




   function steal()
   {
     if( func_num_args() == 0 )
     {
       return $this->steal;
     }

     else if( func_num_args() == 1 )
     {
     $this->steal = (int)func_get_arg(0);
     }

     return $this;
   }


   function foul()
   {
     if( func_num_args() == 0 )
     {
       return $this->foul;
     }

     else if( func_num_args() == 1 )
     {
      $this->foul = (int)func_get_arg(0);
     }

     return $this;
   }



   function block()
   {
     if( func_num_args() == 0 )
     {
       return $this->block;
     }

     else if( func_num_args() == 1 )
     {
     $this->block = (int)func_get_arg(0);
     }

     return $this;
   }

   function ftm()
   {
     if( func_num_args() == 0 )
     {
       return $this->ftm;
     }

     else if( func_num_args() == 1 )
     {
       $this->ftm = (int)func_get_arg(0);
     }

     return $this;
   }





   function assists()
   {
     // int assists()
     if( func_num_args() == 0 )
     {
       return $this->assists;
     }

     // void assists($value)
     else if( func_num_args() == 1 )
     {
       $this->assists = (int)func_get_arg(0);
     }

     return $this;
   }








   // rebounds() prototypes:
   //   int rebounds()               returns the number of rebounds taken.
   //
   //   void rebounds(int $value)    set object's $rebounds attribute
   function rebounds()
   {
     // int rebounds()
     if( func_num_args() == 0 )
     {
       return $this->rebounds;
     }

     // void rebounds($value)
     else if( func_num_args() == 1 )
     {
       $this->rebounds = (int)func_get_arg(0);
     }

     return $this;
   }








   function __construct($name="", $time="0:0",$gameid=0, $points=0, $assists=0, $rebounds=0 , $three_points=0,$fta=0, $steal=0, $foul=0,$block=0, $ftm=0)
   {
     // delegate setting attributes so validation logic is applied
     $this->name($name);
     $this->playingTime($time);
     $this->gameid($gameid);
     $this->pointsScored($points);
     $this->assists($assists);
     $this->rebounds($rebounds);
     $this->three_points($three_points);
     $this->ftm($ftm);
     $this->fta($fta);
     $this->foul($foul);
     $this->block($block);
     $this->steal($steal);

   }








   function __toString()
   {
     return (var_export($this, true));
   }








   // Returns a tab separated value (TSV) string containing the contents of all instance attributes
   function toTSV()
   {
       return implode("\t", [$this->name(), $this->playingTime(), $this->gameid(), $this->pointsScored(), $this->assists(), $this->rebounds(),
        $this->fta(),
        $this->three_points(),
        $this->block(),
        $this->steal(),
        $this->foul(),
        $this->ftm()]);
   }








   // Sets instance attributes to the contents of a string containing ordered, tab separated values
   function fromTSV(string $tsvString)
   {
     // assign each argument a value from the tab delineated string respecting relative positions
     list($name, $time, $points, $assists, $rebounds,
          $three_points,$fta, $steal, $foul,$block, $ftm


     ) = explode("\t", $tsvString);
     $this->name($name);
     $this->playingTime($time);
     $this->pointsScored($points);
     $this->assists($assists);
     $this->rebounds($rebounds);
     $this->three_points($three_points);
     $this->fta($fta);
     $this->steal($steal);
     $this->foul($foul);
    $this->block($block);
     $this->ftm($ftm);

   }
} // end class PlayerStatistic

?>
