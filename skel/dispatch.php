<?php
  // Setup the system
  $config_atkroot = "./";
  include_once("atk.inc");

  atksession();
  
  $session = &atkSessionManager::getSession(); 
  
  if($ATK_VARS["atknodetype"]=="" || $session["login"]!=1)
  {
    // no nodetype passed, or session expired
    $g_layout->initGui();
    $g_layout->ui_top(text("title_session_expired"));
    $g_layout->output("<br><br>".text("explain_session_expired")."<br><br><br><br>");
    $g_layout->ui_bottom();
    $g_layout->page(text("title_session_expired"));
  }
  else
  {
    atksecure();

    atklock();

    // Create node
    $obj = &getNode($ATK_VARS["atknodetype"]);

    if (is_object($obj))
    {
      $obj->dispatch($ATK_VARS);
    }
    else
    {
      atkdebug("No object created!!?!");
    }
  }
  $g_layout->outputFlush();
?>
