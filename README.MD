**欢迎使用FastSwoole**

基于php + swoole扩展开发的web框架

框架宗旨大道至简，一款简洁快速的微框架，适合api和微服务

开发文档：https://www.kancloud.cn/panco/panco/864408

~~~~

 安装步骤：

1、新建项目：
    正式版： composer create-project panco/fast-swoole
    开发版： git clone https://github.com/panco95/fastSwoole.git
             cd fastSwoole
             composer install
    
    *Docker*：Docker: docker pull composer
             docker run --rm --interactive --tty  -v /data/fastSwoole:/app composer create-project panco/fast-swoole
             cd /data/fastSwoole

2、安swoole扩展：pecl install swoole

3、开启Http服务：php start.php start

4、浏览器访问 127.0.0.1.8001`（127.0.0.1是本机ip，使用时请改成服务器或虚拟机IP）
