<?php
namespace lsdproject\forms;

use std, gui, framework, lsdproject;


class MainForm extends AbstractForm
{

    /**
     * @event shutdown.click-Left 
     */
    function doShutdownClickLeft(UXMouseEvent $e = null)
    {    
        
    }

    /**
     * @event hidewindow.click-Left 
     */
    function doHidewindowClickLeft(UXMouseEvent $e = null)
    {    
        
    }

    /**
     * @event showing 
     */
    function doShowing(UXWindowEvent $e = null)
    {    
         $tilepane = new UXTilePane();
         $tilepane->orientation = 'HORIZONTAL'; 
         $tilepane->prefColumns = 3;
         $tilepane->prefRows = 3;
         $tilepane->minSize = [635, 500];
         $tilepane->hgap = 5;
         $tilepane->vgap = 5; 
         $tilepane->alignment = 'TOP_LEFT';
         $tilepane->tileAlignment = 'TOP_LEFT';
         $tilepane->prefTileWidth = -1;
         $tilepane->prefTileHeight = -1;
         $tilepane->paddingTop = 5;
         $tilepane->paddingRight = 5; 
         $tilepane->paddingBottom = 5; 
         $tilepane->paddingLeft = 5; 
         $tilepane->id = 'tilePane';
         $tilepane->backgroundColor = 'null';
         $tilepane->style = "-fx-border-width: 0";
         $this->container->content->add($tilepane);  
         //$this->doShowing();   
         
        $this->tilePane->children->clear();
            $list = null;
                                                       
            $directory = new File($this->edit->text);  
                         
            $list = $directory->findFiles(); 
           
            if($list) {
                foreach ($list as $v) {                 
                     $imageBox = new UXVBox();
                     $imageBox->alignment = 'CENTER';
                     $imageBox->backgroundColor = 'white';
                     $imageBox->style = "-fx-border-width: 0;";
                     $imageBox->padding = 4;
                     $imageBox->spacing = 2;
                     $imageBox->maxSize = [100, 70];
                     $imageBox->on('click', function (UXMouseEvent $e) use ($v) {
                         if ($e->clickCount >= 2) { 
                             if (fs::ext($v) == null){
                                 $this->edit->text = $v;
                                 //$this->doShowing();
                                 
                             } else {
                                 open($v);
                             }
                         } else { 
                             
                         }
                     });
                     if (fs::ext($v) == "cmd"){
                         $ImageArea = new UXImageArea(new UXImage("res://.data/img/mod.png"));
                     } elseif (fs::ext($v) == "bat"){
                         $ImageArea = new UXImageArea(new UXImage("res://.data/img/contentpack.png"));
                     } elseif (fs::ext($v) == null){
                         $ImageArea = new UXImageArea(new UXImage("res://.data/img/folder.png"));
                     } else {
                         $ImageArea = new UXImageArea(new UXImage("res://.data/img/file.png"));
                     }
                     $ImageArea->height = 45;
                     $ImageArea->width = 45;
                     $ImageArea->centered = true;
                     $ImageArea->stretch = true;
                     $ImageArea->smartStretch = true;
                     $imageBox->add($ImageArea);
                     
                     $Label = new UXLabel(fs::name($v));  
                     $Label->textColor = "#333";
                     $Label->wrapText = true;            
                     $imageBox->add($Label);
                                       
                     $this->tilePane->add($imageBox);                                 
                }               
            } 
        
    }

    /**
     * @event edit.keyDown-Enter 
     */
    function doEditKeyDownEnter(UXKeyEvent $e = null)
    {    
        $this->doShowing();
    }


}
