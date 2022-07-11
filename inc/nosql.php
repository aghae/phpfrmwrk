<?php 

class nosql{

  function getstore($storeName){

    
    // //  $query = getinstance('Query','lib/sleekdb');
    //  $storeConfiguration =[];
    //        // [
    //   // "auto_cache" => true,
    //   // "cache_lifetime" => null,
    //   // "timeout" => 120,
    //   // "primary_key" => "_id",
    //   // "search" => [
    //   //   "min_length" => 2,
    //   //   "mode" => "or",
    //   //   "score_key" => "scoreKey",
    //   //   "algorithm" => $query::SEARCH_ALGORITHM["hits"]
    //   // ]
    //   // ];

     return getinstance('\SleekDB\Store','lib/sleekdb',[$storeName,NOSQL_PATH],$storeConfiguration);
  }    

}
