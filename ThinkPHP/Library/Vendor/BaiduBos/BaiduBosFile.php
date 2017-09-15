<?php

/**
 * 百度BOS文件上传处理类
 * @author    郑杰 北京云天软件 <380138540@qq.com>
 */
 
include 'BaiduBce.phar';
//require 'SampleConf.php';
use BaiduBce\BceClientConfigOptions;
use BaiduBce\Util\Time;
use BaiduBce\Util\MimeTypes;
use BaiduBce\Http\HttpHeaders;
use BaiduBce\Services\Bos\BosClient;
use BaiduBce\Services\Bos\CannedAcl;
use BaiduBce\Services\Bos\BosOptions;
use BaiduBce\Auth\SignOptions;
use BaiduBce\Log\LogFactory;

class BaiduBosFile {//类定义开始

    var $BOS_CONFIG =
			array(
				'credentials' => array(
					'ak' => 'tGYalTmbGyF2ZzBwtCCwQpaM',
					'sk' => 'cOlg9UpLzQEMdd5LrrfYoffNFchgNOol',
				),
				'endpoint' => 'http://bj.bcebos.com',
			);	   
    var $bucketName="ytsoft-yunpan";			
			
    public function uploadBos($key,$upfile) {   //上传文件
	   $client = new BosClient($this->BOS_CONFIG);
	   $response = $client->putObjectFromFile($this->bucketName,$key,$upfile);
	   return $response;
    }
	
    public function deleteObject($objectKey) {    //删除文件
	   $client = new BosClient($this->BOS_CONFIG);
	   $response = $client->deleteObject($this->bucketName, $objectKey);
	   return $response;
    }

}
