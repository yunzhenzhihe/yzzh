<?php
namespace Home\Model;
use Think\Model;
class ImageModel extends Model{
    protected $_auto = array(
        array('branch_id','getBranch_id',1,'callback'),  // 新增的时候把branch_id字段设置为 分支机构id  $_SESSION['branch_id'];
        array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
        array('creat_time','getTIme',1,'callback')
    );
    protected function  getCompany_id(){   // 得到company_id session值
        return $_SESSION['company_id'];
    }

    protected function  getBranch_id(){   // 得到branch_id session值 分支机构id
        return $_SESSION['branch_id'];
    }

    protected function getTime(){
        return date('Y-m-d H:i:s');
    }
}