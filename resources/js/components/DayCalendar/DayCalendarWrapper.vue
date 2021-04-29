<template>
    <div>
        <TopNavigation />
        <div class="container-fluid">
            <div class="row">
                <LeftNavigation />
                <DayCalendar />
            </div>
        </div>
    </div>
</template>

<script>
import TopNavigation from "../Navigation/TopNavigationBar/TopNavigation"
import LeftNavigation from "../Navigation/LeftNavigationBar/LeftNavigation"
import DayCalendar from  "./DayCalendar"
export default {
    name: "DayCalendarWrapper",
    components: {
        LeftNavigation,
        TopNavigation,
        DayCalendar
    }
}
</script>
