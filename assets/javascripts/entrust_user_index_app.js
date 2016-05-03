/**
 *= require entrust_app
 */

app.controller('userController', function($scope, $http, $mdDialog, $mdMedia, $mdToast) {

    $scope.customFullscreen = $mdMedia('xs') || $mdMedia('sm');

    $scope.showConfirm = function(ev, user, csrf) {
        var element = document.getElementById('user-' + user.id + '-state');
        var text    = element.innerText || element.textContent;
        var state   = (text == 'disabled')? 'active' : 'disable';

        // Appending dialog to document.body to cover sidenav in docs app
        var confirm = $mdDialog.confirm()
            .title('Update: ' + user.firstname + ' ' + user.lastname )
            .textContent('Are you sure you want to ' + state + ' the user?')
            .ariaLabel('deactivate user')
            .targetEvent(ev)
            .ok(state)
            .cancel('Cancel');

        $mdDialog.show(confirm).then(function() {
            $scope._updateUser(user.id, (text != 'disabled'), csrf);
        }, function() {
            console.log('Update User - Cancel');
        });
    };

    $scope._updateUser = function(user_id, state, csrf) {
        var token = {
            'id' : user_id,
            'deleted' : state
        };
        token[csrf.name] = csrf.hash;

        var element = document.getElementById('user-' + user_id + '-state');

        $http({
            method: 'POST',
            url: 'http://' + document.location.host + '/index.php/entrust/api/cerberus/user/enable',
            data: token
        })
        .then(function(data) {
            element.innerHTML = (token['deleted']) ? 'disabled' : 'active';

            $mdToast.show(
                $mdToast.simple()
                .textContent('User Updated!')
                .action('UNDO')
                .highlightAction(true)
                .position('bottom right')
                .hideDelay(3000)
            ).then(function(response) {
                if (response == 'ok') {
                    $scope._updateUser(user_id, !state, csrf);
                }
            });
        }, function(data) {
                console.log('error', data);
        });
    };
});