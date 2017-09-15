<?php
namespace Home\Controller;
use Think\Controller;

//帮助提示框 模块
class HelpController extends Controller {
 
	function help_setarea(){   //客户运营范围设置
        $this->display();	
	}
	
	function help_setcompany(){   //公司信息设置
        $this->display();	
	}	
	
	function help_setsettlement(){   //结算政策设置
        $this->display();	
	}	
	
	
	function help_mydriver(){   //司机管理
        $this->display();	
	}
	
	function help_mydrivercard(){   //司机会员卡管理
        $this->display();	
	}		
	
	function help_customer(){   //客户管理/生成订单
        $this->display();	
	}
	
	function help_customerjs(){   //做订单 显示 地图的模块 客户的属性右侧的部分
        $this->display();	
	}	
	
	function help_customercard(){   //客户会员卡管理
        $this->display();	
	}
	
	function help_ordersettlement(){   //订单结算
        $this->display();	
	}
	
   function help_mobileagreement(){   //移动终端注册时的 注册协议
        $this->display();	
	}
	
   function help_about(){   //pc客户端 系统关于
        $this->display();	
	}	
/* 开始售后项目的帮助文档*/	

   function help_salesprocessconfirm(){   //销售订单审核 帮助
        $this->display();	
	}	
	
   function help_salesprocessprint(){   //销售订单打印 帮助
        $this->display();	
	}

   function help_salesprocessdispatch(){   //销售订单分配配送员 帮助
        $this->display();	
	}	
	
   function help_salesprocesscompleted(){   //销售订单配送完成确认 帮助
        $this->display();	
	}	
	
   function help_setdeliveryman(){   //配送人员设置 帮助
        $this->display();	
	}	
	
   function help_stockinconfirm(){   //订单入库审核 帮助
        $this->display();	
	}	
	
   function help_stockloss(){   //商品毁损订单录入\修改\删除 帮助
        $this->display();	
	}	
	
   function help_stocklossconfirm(){   //毁损订单审核出库 帮助
        $this->display();	
	}
	
   function help_stockservicestaffout(){   //售后人员领料 帮助
        $this->display();	
	}
	
   function help_stockservicestaffin(){   //售后人员退料 帮助
        $this->display();	
	}	
	
   function help_stockservicestaffoutconfirm(){   //售后人员领料 订单审核 帮助
        $this->display();	
	}	
	
   function help_stockservicestaffinconfirm(){   //售后人员退料 订单审核 帮助
        $this->display();	
	}	
	
   function help_serviceprocessdispatch(){   //售后派工（安排售后人员） 帮助
        $this->display();	
	}
	
   function help_errorconfirmsales(){   //销售订单审核错误更正 帮助
        $this->display();	
	}
	
   function help_errorconfirmreturnsales(){   //退货订单审核错误更正 帮助
        $this->display();	
	}		
	
   function help_returnsaleslist(){   //销售订单退货处理 帮助
        $this->display();	
	}	
	
   function help_returnconfirmlist(){   //销售订单 退货订单审核入库 帮助
        $this->display();	
	}		
	
   function help_errorconfirmservice(){   //售后订单审核错误更正 帮助
        $this->display();	
	}	
	
   function help_customercalllist(){   //客户来电日志 帮助
        $this->display();	
	}	
	
   function help_mapservicestaff(){   //售后人员地图 帮助
        $this->display();	
	}			
}