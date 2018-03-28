<template>
	<list-view
		title="Branches"
		url="/branches"
		resource="branches"
		:searchFields="searchFields"
		:listRows="listRows"
		:buttons="buttons"
		sortBy="name"
	/>
</template>

<script>
import listView from '../../components/listView'

export default {
  	components: {
		listView
	},
	data() {
		return {
			sortBy: 'name',
			searchFields: [
				{ 'field': 'name', 'class': 'col'},
			],
			listRows: [
					{ 
						'id': 1, 'showFields': [
							{ 'field': 'name', 'class': 'col'}
						]
					},
			],
			buttons: [
				{ 'id': 1, 'caption': 'policies', 'path': 'policies', 'field': 'policies_count'}
			]
		}
	}
}
</script>
