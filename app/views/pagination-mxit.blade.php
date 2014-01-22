<?php
	namespace Illuminate\Pagination;
	class MxitAppPresenterNewabc extends CircularPresenter{
		/**
		 * Get HTML wrapper for a page link.
		 *
		 * @param  string  $url
		 * @param  int  $page
		 * @return string
		 */
		public function getPageLinkWrapper($url, $page)
		{
			return '<td><a href="'.$url.'">'.$page.'</a></td>';
		}

		/**
		 * Get HTML wrapper for disabled text.
		 *
		 * @param  string  $text
		 * @return string
		 */
		public function getDisabledTextWrapper($text)
		{
			return '<td><span>'.$text.'</span></td>';
		}

		/**
		 * Get HTML wrapper for active text.
		 *
		 * @param  string  $text
		 * @return string
		 */
		public function getActivePageWrapper($text)
		{
			return '<td><span>'.$text.'</span></td>';
		}
	}
	$presenter = new MxitAppPresenterNewabc($paginator);

	$trans = $environment->getTranslator();
?>

<?php if ($paginator->getLastPage() > 1): ?>
	<table class="pager" width="100%" align="center" title="mxit:table:full">
        <tr>
		<?php
			echo $presenter->getPrevious($trans->trans('pagination.previous'));
            $rand = rand(1,$paginator->getTotal());
            echo $presenter->getPageLinkWrapper(\Request::url().'?page='.$rand ,'Random');
			echo $presenter->getNext($trans->trans('pagination.next'));
		?>
        </tr>
	</table>
<?php endif; ?>
