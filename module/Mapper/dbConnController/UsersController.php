<?php

namespace Mapper;

include __DIR__ . '/../../Mapper/dbConnMapper/Users.php';
class UsersController

{
    private $config ;
    private $usersMapper;

    public function __construct()
    {
        $this->config = include __DIR__ . '/../../Mapper/common/config.php';
        $this->usersMapper = new Users($this->config);
    }

    public function layoutFindChoce()
    {
        ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Nick</td>
                <td><?= $this->usersMapper->dataUsers('username',1)?></td>
                <td>
                <span class="label label-inline label-light-primary font-weight-bold">
                    Pending
                </span>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Ana</td>
                <td>Jacobs</td>
                <td>
                <span class="label label-inline label-light-success font-weight-bold">
                    Approved
                </span>
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>Pettis</td>
                <td>
                <span class="label label-inline label-light-danger font-weight-bold">
                    New
                </span>
                </td>
            </tr>
            </tbody>
        </table>
<?php
    }

}