<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{meta}
</head>
<body>
    <div id="wrapper">
        <div id="header">
            {header}
        </div> 
        <div id="main">
            <div id="sidebar">
                {sidebar}
            </div>
			<div id="title"><?php echo $category_title;?></div>

            <div id="content">
                <?php if($this->session->flashdata('error')){?>
                    <div id="error">
                        <?php echo $this->session->flashdata('error');?>
                    </div>
                <?php }?>

                <?php if($this->session->flashdata('success')){?>
                    <div id="success">
                        <?php echo $this->session->flashdata('success');?>
                    </div>
                <?php }?>

                {content}
            </div>
            <div class="clear"></div>
        </div>
        <div id="footer">
            {footer}
        </div>
    </div>
</body>
</html>