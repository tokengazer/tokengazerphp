<?php

         //SAE需要手动建立一个test，然后通过如下代码调用使用

        $t = new SaeTaskQueue("test");
for($i=1;$i<=8;*i++){
        $t->addTask("http://2.tokenworm.applinzi.com/tokenmarket.php?p=".$i); //添加列队任务1
}
        if (!$t->push()) {
            echo '出错:' . $t->errmsg();
        } else {
            echo '执行成功！请查看[' . LOG_PATH . 'sae_debug.log' . ']文件中的日志';
        }

      //列队任务1
      public function tq_test1() {
           sae_debug("列队任务1被执行"); 
      }

      //列队任务2
      public function tq_test2() {
           sae_debug("列队任务2被执行,k1的值：{$_POST['k1']},k2的值:{$_POST['k2']}"); 
      }



 ?>