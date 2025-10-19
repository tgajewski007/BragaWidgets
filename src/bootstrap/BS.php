<?php
namespace braga\widgets\bootstrap;

/**
 * BS – wersja dla Bootstrap 5.3
 * – ten sam interfejs, ta sama kolejność metod co w oryginale BS (BS3)
 * – brak BaseTags/Tags; czysty heredoc
 */
class BS
{
	// ========================= HELPERY (wew.) =========================
	// -----------------------------------------------------------------------------------------------------------------
	private static function mapBtnClasses(string $base): string
	{
		$map = [
			'btn-default' => 'btn-secondary',
			'btn-primary' => 'btn-primary',
			'btn-success' => 'btn-success',
			'btn-info'    => 'btn-info',
			'btn-warning' => 'btn-warning',
			'btn-danger'  => 'btn-danger',
			'btn-link'    => 'btn-link',
			'btn-block'   => 'w-100', // BS5
		];
		$parts = preg_split('/\s+/', trim($base));
		$out = [];
		foreach($parts as $p)
		{
			$out[] = $map[$p] ?? $p;
		}
		return implode(' ', array_filter($out));
	}
	// -----------------------------------------------------------------------------------------------------------------
	private static function mapPanelClassToCardBorder(string $panelClass): string
	{
		// "panel-default" → "border-secondary", "panel-primary" → "border-primary", itd.
		$map = [
			'panel-default' => 'border-secondary',
			'panel-primary' => 'border-primary',
			'panel-success' => 'border-success',
			'panel-info'    => 'border-info',
			'panel-warning' => 'border-warning',
			'panel-danger'  => 'border-danger',
		];
		$parts = preg_split('/\s+/', trim($panelClass));
		$out = [];
		foreach($parts as $p)
		{
			$out[] = $map[$p] ?? $p;
		}
		// zawsze dodajemy minimalne marginesy jak dawniej
		if(!in_array('mb-3', $out, true))
		{
			$out[] = 'mb-3';
		}
		return implode(' ', array_filter($out));
	}

	// ========================= 1:1 – KOLEJNOŚĆ Z ORYGINAŁU =========================
	// -----------------------------------------------------------------------------------------------------------------
	public static function box($title, $content, $baseClass = 'panel-default')
	{
		$cardBorder = self::mapPanelClassToCardBorder($baseClass);
		$retval = <<<HTML
			<div class="card {$cardBorder}">
				<div class="card-header"><h3 class="card-title">{$title}</h3></div>
				<div class="card-body">
					{$content}
				</div>
			</div>
			HTML;
		return $retval;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function panel($content, $baseClass = 'panel-default')
	{
		$cardBorder = self::mapPanelClassToCardBorder($baseClass);
		$retval = <<<HTML
			<div class="card {$cardBorder}">
				<div class="card-body">
					{$content}
				</div>
			</div>
			HTML;
		return $retval;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function formRow($widget, $addHasError = false)
	{
		$err = $addHasError ? ' hasError' : '';
		return <<<HTML
			<div class="mb-3{$err}">
				{$widget}
			</div>
			HTML;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function viewLine($desc, $real)
	{
		// BS3: col-xs-12 col-sm-6 col-md-4 col-md-3  → BS5: col-12 col-sm-6 col-md-4 col-lg-3
		$left = <<<HTML
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">{$desc}</div>
			HTML;
		$right = <<<HTML
			<div class="col-12 col-sm-6 col-md-8 col-lg-9"><b>{$real}</b></div>
			HTML;
		$row = <<<HTML
			<div class="row">{$left}{$right}</div>
			HTML;
		return <<<HTML
			<div class="mb-3">{$row}</div>
			HTML;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function submit($label, $baseClass = 'btn-default btn-block')
	{
		$cls = 'btn ' . self::mapBtnClasses($baseClass);
		return <<<HTML
			<input type="submit" value="{$label}" class="{$cls}">
			HTML;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function button($content, $attrb, $baseClass = "btn-default btn-block")
	{
		$cls = 'btn ' . self::mapBtnClasses($baseClass);
		// $attrb przyjmujemy „as is” (tak jak wcześniej); dokładamy class na koniec
		return <<<HTML
			<button {$attrb} class="{$cls}">{$content}</button>
			HTML;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function listGroup($content)
	{
		return <<<HTML
		<div class="list-group">{$content}</div>
		HTML;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function listItemAjaxLink($href, $label, $defaultClass = "")
	{
		$class = trim($defaultClass . ' list-group-item list-group-item-action');
		$onClick = "onclick=\"\$(this).parent().children('a').removeClass('active');setTimeout(function(sender){\$(sender).addClass('active')}(this),50);ajax.go(this);return false;\"";
		return <<<HTML
			<a href="{$href}" class="{$class}" {$onClick}>{$label}</a>
			HTML;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function listGroupItemAjax($label, $labelHref, $iconHref, $idContener)
	{
		// zachowuję zachowanie JS z oryginału
		$class = "list-group-item list-group-item-action";
		$onClick = "onclick=\"return ajax.go(this);\"";
		$icon = <<<HTML
			<i class="fa fa-caret-right fa-lg fa-fw" onclick="listGroupItemAjax(event, this,'{$idContener}','{$iconHref}');return false;"></i>
			HTML;
		$link = <<<HTML
			<a href="{$labelHref}" class="{$class}" {$onClick}>{$icon}{$label}</a>
			HTML;
		$child = <<<HTML
			<div id="{$idContener}" class="hidden" style="padding-left:8px;"></div>
			HTML;
		return $link . $child;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function treeItemList($activeLink, $branchContent)
	{
		$idContener = uniqid('bs_', true);
		$icon = <<<HTML
			<i class="fa fa-caret-right fa-lg fa-fw" onclick="$('#{$idContener}').toggle();$(this).toggleClass('fa-caret-right');$(this).toggleClass('fa-caret-down');"></i>
			HTML;
		$head = <<<HTML
			<span class="list-group-item list-group-item-action">{$icon}{$activeLink}</span>
			HTML;
		$child = <<<HTML
			<div id="{$idContener}" style="padding-left:8px;display:none;">{$branchContent}</div>
			HTML;
		return $head . $child;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function treeItemListSimple($descriprion, $branchContent)
	{
		$idContener = uniqid('bs_', true);
		$icon = <<<HTML
			<i class="fa fa-caret-right fa-lg fa-fw"></i>
			HTML;
		$onClick = "onclick=\"$('#{$idContener}').toggle();$(this).closest('i').toggleClass('fa-caret-right');$(this).closest('i').toggleClass('fa-caret-down');\"";
		$head = <<<HTML
			<span class="hand list-group-item list-group-item-action" {$onClick}>{$icon}{$descriprion}</span>
			HTML;
		$child = <<<HTML
			<div id="{$idContener}" style="padding-left:8px;display:none;">{$branchContent}</div>
			HTML;
		return $head . $child;
	}
	// -----------------------------------------------------------------------------------------------------------------
	// Pola – pozostają jak w oryginale (wywołują Twoje klasy pól)
	public static function textField($label, $name, $value = null, $required = false, $maxLength = 255)
	{
		$field = new TextField();
		$field->setRequired($required);
		$field->setName($name);
		$field->setSelected($value);
		$field->setLabel($label);
		$field->setMaxLength($maxLength);
		return $field->out();
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function memoField($label, $name, $value = null, $required = false, $maxLength = 65535)
	{
		$field = new MemoField();
		$field->setRequired($required);
		$field->setName($name);
		$field->setSelected($value);
		$field->setLabel($label);
		$field->setMaxLength($maxLength);
		return $field->out();
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function passwordField($label, $name, $value = null, $required = false)
	{
		$field = new TextField();
		$field->setType("password");
		$field->setRequired($required);
		$field->setName($name);
		$field->setSelected($value);
		$field->setLabel($label);
		return $field->out();
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function checkbox2($label, $name, $checked = false, $value = null)
	{
		$checkedClass = 'fa-check-square-o';
		$unCheckedClass = 'fa-square-o';
		$onChange = "onchange=\"if($(this).prop('checked')){\$(this).parent().removeClass('{$unCheckedClass}').addClass('{$checkedClass}');}else{\$(this).parent().removeClass('{$checkedClass}').addClass('{$unCheckedClass}');}return false;\"";

		$chk = $checked ? "checked" : "";
		$hidden = <<<HTML
			<input type="checkbox" class="h" id="{$name}" name="{$name}" {$chk} value="{$value}" {$onChange}>
			HTML;
		$iconClick = "onclick=\"$(this).children().first().click();\"";
		$icon = <<<HTML
			<i class="fa fa-lg fa-fw {$checkedClass}" style="float:left;" {$iconClick}>{$hidden}</i>
			HTML;
		$lbl = '';
		if(!empty($label))
		{
			$lbl = "<label for=\"{$name}\" style=\"display:inline;\">{$label}</label>";
		}
		return <<<HTML
			<div style="clear:both; padding:4px 0">{$icon}{$lbl}</div>
			HTML;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function checkbox($label, $name, $checked = false)
	{
		$field = new CheckBoxField();
		$field->setName($name);
		$field->setSelected($checked);
		$field->setLabel($label);
		return $field->out();
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function dateField($label, $name, $value, $required = false)
	{
		$field = new DateField();
		$field->setName($name);
		$field->setSelected($value);
		$field->setLabel($label);
		$field->setRequired($required);
		return $field->out();
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function fileField($label, $name, $baseClass = 'btn-default')
	{
		$mappedBtn = self::mapBtnClasses($baseClass);
		$i = <<<HTML
			<input type="file" id="{$name}" name="{$name}" class="h">
			HTML;
		$btn = <<<HTML
			<label class="btn {$mappedBtn}">Przeglądaj {$i}</label>
			HTML;
		$l = <<<HTML
			<label for="{$name}">{$label}</label>
			HTML;
		$script = <<<HTML
			<script type="text/javascript">initBSFileField('{$name}');</script>
			HTML;
		return self::formRow($l . $btn) . $script;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function fileFieldAjax($label, $name, $baseClass = 'btn-default')
	{
		$id = substr(md5(uniqid('', true)), 0, 10);
		$mappedBtn = self::mapBtnClasses($baseClass);

		$file = <<<HTML
			<input type="file" id="{$id}" name="{$name}" class="h">
			HTML;
		$btn = <<<HTML
			<label class="btn {$mappedBtn}">Przeglądaj {$file}</label>
			HTML;
		$hiddenVal = <<<HTML
			<input type="hidden" name="{$name}" id="{$id}_hidden">
			HTML;
		$hiddenName = <<<HTML
			<input type="hidden" id="{$id}_file_name" name="{$name}_file_name">
			HTML;
		$l = <<<HTML
			<label for="{$id}">{$label}</label>
			HTML;
		$script = <<<HTML
			<script type="text/javascript">fileFieldAjax.initBSFileFieldAjax('{$id}');</script>
			HTML;
		return self::formRow($l . $btn . $hiddenVal . $hiddenName) . $script;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function numericField($label, $name, $value, $required = false, $precision = 0)
	{
		$field = new FloatField();
		$field->setLabel($label);
		$field->setName($name);
		$field->setSelected($value);
		$field->setRequired($required);
		$field->setPrecision($precision);
		return $field->out();
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function getToolTip($txt, $position = "auto")
	{
		// BS5: data-bs-toggle / data-bs-placement / data-bs-html
		return "title='{$txt}' data-bs-toggle='tooltip' data-bs-html='true' data-bs-placement='{$position}'";
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function dateTimeField($label, $name, $value, $required = false)
	{
		$field = new DateTimeField();
		$field->setName($name);
		$field->setSelected($value);
		$field->setLabel($label);
		$field->setRequired($required);
		return $field->out();
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function bootstrapCss(): string
	{
		$href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css';
		return <<<HTML
		<link rel="stylesheet" href="{$href}">
		HTML;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function bootstrapJs(): string
	{
		$src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js';
		return <<<HTML
		<script src="{$src}"></script>
		HTML;
	}
	// -----------------------------------------------------------------------------------------------------------------
}
