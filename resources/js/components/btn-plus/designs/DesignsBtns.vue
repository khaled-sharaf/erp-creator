<template>
    <div>
        <btn-plus>
            <li>
                <router-link
                    :to="{name: 'users-create'}"
                >
                    test link
                    <i class="fa fa-plus fa-fw"></i>
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

