<template>
    <div>
        <btn-plus>
            <li>
                <router-link
                    :to="{name: 'users-create'}"
                    class="waves-effect"
                >
                    {{ $t('global.create') + ' ' + $t('sidebar.new_user') }}
                    <i class="fa fa-plus fa-fw"></i>
                </router-link>
            </li>
            <li>
                <router-link
                    :to="{name: 'hr-model'}"
                    class="waves-effect"
                >
                    HR
                    <i class="fa fa-eye fa-fw"></i>
                </router-link>
            </li>
        </btn-plus>
    </div>
</template>


<script>

import btnPlus from '../BtnPlus'

export default {
    components: {
        btnPlus
    }
}
</script>

