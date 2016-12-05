<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
sendVarToJS('eqType', 'tasker');
$eqLogics = eqLogic::byType('tasker');
?>

<div class="row row-overflow">
  <div class="col-lg-2 col-md-3 col-sm-4">
    <div class="bs-sidebar">
      <ul id="ul_eqLogic" class="nav nav-list bs-sidenav">
        <a class="btn btn-default eqLogicAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter un template}}</a>
        <li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
        <?php
foreach ($eqLogics as $eqLogic) {
	echo '<li class="cursor li_eqLogic" data-eqLogic_id="' . $eqLogic->getId() . '"><a>' . $eqLogic->getHumanName(true) . '</a></li>';
}
?>
     </ul>
   </div>
 </div>

 <div class="col-lg-10 col-md-9 col-sm-8 eqLogicThumbnailDisplay" style="border-left: solid 1px #EEE; padding-left: 25px;">
  <legend>{{Mes taskers}}</legend>
  <legend><i class="fa fa-cog"></i>  {{Gestion}}</legend>
  <div class="eqLogicThumbnailContainer">
    <div class="cursor eqLogicAction" data-action="add" style="text-align: center; background-color : #ffffff; height : 120px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >
      <i class="fa fa-plus-circle" style="font-size : 6em;color:#94ca02;"></i>
    <br>
    <span style="font-size : 1.1em;position:relative; top : 23px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#94ca02">{{Ajouter}}</span>
  </div>
  <div class="cursor eqLogicAction" data-action="gotoPluginConf" style="text-align: center; background-color : #ffffff; height : 120px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;">
      <i class="fa fa-wrench" style="font-size : 6em;color:#767676;"></i>
    <br>
    <span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#767676">{{Configuration}}</span>
  </div>
</div>
<legend><i class="fa fa-table"></i> {{Mes taskers}}</legend>
<div class="eqLogicThumbnailContainer">
  <?php
foreach ($eqLogics as $eqLogic) {
	echo '<div class="eqLogicDisplayCard cursor" data-eqLogic_id="' . $eqLogic->getId() . '" style="text-align: center; background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >';
	echo '<img src="plugins/tasker/doc/images/tasker_icon.png" height="105" width="95" />';
	echo "<br>";
	echo '<span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;">' . $eqLogic->getHumanName(true, true) . '</span>';
	echo '</div>';
}
?>
</div>
</div>

<div class="col-lg-10 col-md-9 col-sm-8 eqLogic" style="border-left: solid 1px #EEE; padding-left: 25px;display: none;">
	<a class="btn btn-success eqLogicAction pull-right" data-action="save"><i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
  <a class="btn btn-danger eqLogicAction pull-right" data-action="remove"><i class="fa fa-minus-circle"></i> {{Supprimer}}</a>
  <ul class="nav nav-tabs" role="tablist">
   <li role="presentation" class="active"><a href="#eqlogictab" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-tachometer"></i> {{Equipement}}</a></li>
   <li role="presentation"><a href="#commandtab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i> {{Commandes}}</a></li>
 </ul>

 <div class="tab-content" style="height:calc(100% - 50px);overflow:auto;overflow-x: hidden;">
   <div role="tabpanel" class="tab-pane active" id="eqlogictab">
    <form class="form-horizontal">
      <fieldset>
        <legend><i class="fa fa-arrow-circle-left eqLogicAction cursor" data-action="returnToThumbnailDisplay"></i> {{Général}}  <i class='fa fa-cogs eqLogicAction pull-right cursor expertModeVisible' data-action='configure'></i></legend>
        <div class="form-group">
          <label class="col-sm-3 control-label">{{Nom de l'équipement tasker}}</label>
          <div class="col-sm-3">
            <input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display : none;" />
            <input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom de l'équipement tasker}}"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" >{{Objet parent}}</label>
          <div class="col-sm-3">
            <select id="sel_object" class="eqLogicAttr form-control" data-l1key="object_id">
              <option value="">{{Aucun}}</option>
              <?php
foreach (object::all() as $object) {
	echo '<option value="' . $object->getId() . '">' . $object->getName() . '</option>';
}
?>
           </select>
         </div>
       </div>
       <div class="form-group">
        <label class="col-sm-3 control-label"></label>
        <div class="col-sm-9">
         <label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isEnable" checked/>{{Activer}}</label>
         <label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isVisible" checked/>{{Visible}}</label>
       </div>
     </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">{{Autoremote clef}}</label>
        <div class="col-sm-3">
          <input type="text" class="eqLogicAttr configuration form-control" data-l1key="configuration" data-l2key="autoremote::key" />
        </div>
      </div>
       <div class="form-group">
        <label class="col-sm-3 control-label">{{Autoremote password}}</label>
        <div class="col-sm-3">
          <input type="password" class="eqLogicAttr configuration form-control" data-l1key="configuration" data-l2key="autoremote::password" />
        </div>
      </div>

          <?php
$groups = array();
foreach (tasker::sceneParameters() as $key => $info) {
	if (isset($info['groupe'])) {
		$info['key'] = $key;
		if (!isset($groups[$info['groupe']])) {
			$groups[$info['groupe']][0] = $info;
		} else {
			array_push($groups[$info['groupe']], $info);
		}
	}
}
ksort($groups);
foreach ($groups as $group) {
	usort($group, function ($a, $b) {
		return strcmp($a['name'], $b['name']);
	});
	foreach ($group as $key => $info) {
		if ($key == 0) {
			echo '<legend>{{' . $info['groupe'] . '}}</legend>';
		}
		echo '<div class="form-group">';
		echo '<label class="col-sm-3 control-label">' . $info['name'] . '</label>';
		echo '<div class="col-sm-1">';
		if (isset($info['configuration']) && count($info['configuration']) > 0) {
			echo '<a class="btn btn-warning configureScene" data-scene="' . $info['key'] . '"><i class="fa fa-cog" aria-hidden="true"></i> {{Configurer}}</a>';
		}
		echo '</div>';
		echo '<div class="col-sm-1">';
		echo ' <a class="btn btn-success downloadScene" data-scene="' . $info['key'] . '"><i class="fa fa-download" aria-hidden="true"></i> {{Télécharger}}</a>';
		echo '</div>';
		echo '<div class="col-sm-7 alert alert-info">';
		echo $info['description'];
		echo '</div>';
		echo '</div>';
	}
}
?>
</fieldset>
</form>


</div>
<div role="tabpanel" class="tab-pane" id="commandtab">
  <a class="btn btn-success btn-sm cmdAction pull-right" data-action="add"><i class="fa fa-plus-circle"></i> {{Commandes}}</a><br/><br/>
  <table id="table_cmd" class="table table-bordered table-condensed">
    <thead>
      <tr>
        <th>{{Nom}}</th><th>{{Type}}</th><th>{{Options}}</th><th>{{Paramètres}}</th><th>{{Action}}</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
</div>

</div>
</div>

<?php include_file('desktop', 'tasker', 'js', 'tasker');?>
<?php include_file('core', 'plugin.template', 'js');?>
