<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $mailBodies
 */
?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $mstCountries
 */
?>
<!-- begin:: Page -->
<?= $this->element('mobile_header'); ?>
<div class="kt-grid kt-grid--hor kt-grid--root">
	<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

		<?= $this->element('aside'); ?>
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
			<?= $this->element('header'); ?>
			
			<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

				<?php echo $this->element('content_head', array('page_name'=>'Manage Mail Bodies')); ?>
				<!-- begin:: Content --><?php //pr($this->request->getAttribute('params')); ?>
				<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__body">
                            <!--begin: Datatable -->
                            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                                <thead>
                                    <tr>
                                        <th><?= $this->Paginator->sort('id') ?></th>
                                        <th><?= $this->Paginator->sort('type') ?></th>
                                        <th><?= $this->Paginator->sort('subject') ?></th>
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
    var url = "<?= $this->Url->build(['prefix'=>'Admin', 'controller'=>'MailBodies', 'action'=>'ajax']) ?>";
    var column = [
				{
					targets: -1,
					title: 'Actions',
					orderable: false,
					className: 'text-center'
				}
			];
</script>
<!--begin::Page Scripts(used by this page) -->
<?= $this->Html->script(['../assets/plugins/custom/datatables/datatables.bundle.js','../assets/js/pages/crud/datatables/data-sources/ajax-server-side.js', '../assets/plugins/custom/tinymce/tinymce.bundle.js', '../assets/js/emailTemplate.js']) ?>

<!--end::Page Scripts -->
