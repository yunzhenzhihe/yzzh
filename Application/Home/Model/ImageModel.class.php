<?php
namespace Home\Model;
use Think\Model;
class ImageModel extends Model{
    protected $_auto = array(
        array('branch_id','getBranch_id',1,'callback'),  // ������ʱ���branch_id�ֶ�����Ϊ ��֧����id  $_SESSION['branch_id'];
        array('company_id','getCompany_id',1,'callback'),  // ������ʱ���company_id�ֶ�����Ϊ ��˾id $_SESSION['company_id'])
        array('creat_time','getTIme',1,'callback')
    );
    protected function  getCompany_id(){   // �õ�company_id sessionֵ
        return $_SESSION['company_id'];
    }

    protected function  getBranch_id(){   // �õ�branch_id sessionֵ ��֧����id
        return $_SESSION['branch_id'];
    }

    protected function getTime(){
        return date('Y-m-d H:i:s');
    }
}