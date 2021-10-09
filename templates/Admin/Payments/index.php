<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $payments
 */
?>
<?= $this->element('mobile_header'); ?>
<div class="kt-grid kt-grid--hor kt-grid--root">
	<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

		<?= $this->element('aside'); ?>
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
			<?= $this->element('header'); ?>

			<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

				<?php echo $this->element('content_head', array('page_name'=>'Manage Packages')); ?>
				<!-- begin:: Content --><?php //pr($this->request->getAttribute('params')['_matchedRoute']); ?>
				<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <!--<h3 class="kt-portlet__head-title">
                                    Countries
                                </h3>-->
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                        <div class="dropdown dropdown-inline">
                                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="la la-download"></i> Export
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="kt-nav">
                                                    <li class="kt-nav__section kt-nav__section--first">
                                                        <span class="kt-nav__section-text">Choose an option</span>
                                                    </li>
                                                    <!--<li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon la la-print"></i>
                                                            <span class="kt-nav__link-text">Print</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon la la-copy"></i>
                                                            <span class="kt-nav__link-text">Copy</span>
                                                        </a>
                                                    </li>-->
                                                    <li class="kt-nav__item">
                                                        <?= $this->Html->link('<i class="kt-nav__link-icon la la-file-excel-o"></i><span class="kt-nav__link-text">Excel</span>', ['prefix'=>'Admin','controller' => 'Payments','action' => 'download_excel','excel'], ['class' => 'kt-nav__link', 'escape' => false, 'title'=>'Export Packages In Excel']) ?>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <?= $this->Html->link('<i class="kt-nav__link-icon la la-file-text-o"></i><span class="kt-nav__link-text">CSV</span>', ['prefix'=>'Admin','controller' => 'Payments','action' => 'download_excel','csv'], ['class' => 'kt-nav__link', 'escape' => false, 'title'=>'Export Packages In CSV']) ?>
                                                    </li>
                                                    <!--<li class="kt-nav__item">
                                                        <?php //$this->Html->link('<i class="kt-nav__link-icon la la-file-pdf-o"></i><span class="kt-nav__link-text">PDF</span>', ['prefix'=>'Admin','controller' => 'MstCountries','action' => 'download_excel','pdf'], ['class' => 'kt-nav__link', 'escape' => false, 'title'=>'Export Countries In PDF']) ?>
                                                    </li>-->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <!--begin: Datatable -->
                            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                                <thead>
                                    <tr>
                                        <!--<th><?//= $this->Paginator->sort('id') ?></th>-->
                                        <th><?= $this->Paginator->sort('company') ?></th>
                                        <th><?= $this->Paginator->sort('user_id') ?></th>
                                        <th><?= $this->Paginator->sort('package_id') ?></th>
                                        <th><?= $this->Paginator->sort('amount') ?></th>
                                        <th><?= $this->Paginator->sort('discount_amt') ?></th>
                                        <th><?= $this->Paginator->sort('tax_amount') ?></th>
                                        <th><?= $this->Paginator->sort('net_amount') ?></th>
                                        <th><?= $this->Paginator->sort('payment_date') ?></th>
                                        <th><?= $this->Paginator->sort('package_start_date') ?></th>
                                        <th><?= $this->Paginator->sort('package_end_date') ?></th>
                                        <th><?= $this->Paginator->sort('status') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                            <!--end: Datatable -->
                        </div>
                    </div>
				</div>
				<!-- end:: Content -->
			</div>

			<?= $this->element('footer'); ?>
		</div>
	</div>
</div>

<!-- end:: Page -->

<?= $this->element('quick_panel'); ?>
<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
	<i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->
<!--begin::Modal (For Add and Edit Country) -->
<div class="modal fade" id="kt_modal_country" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="content-data"></div>
            </div>
        </div>
    </div>
</div>

<!--end::Modal-->
<script>
    var url = "<?= $this->Url->build(['prefix'=>'Admin', 'controller'=>'Payments', 'action'=>'ajax']) ?>";
    var column = [
				{
					targets: -1,
					title: 'Actions',
					orderable: false,
					className: 'text-center'
				},
				{
					targets: -2,
					className: 'text-center'
				}
			];
</script>
<!--begin::Page Scripts(used by this page) -->
<?= $this->Html->script(['../assets/plugins/custom/datatables/datatables.bundle.js','../assets/js/pages/crud/datatables/data-sources/ajax-server-side.js','../assets/js/payments.js']) ?>

