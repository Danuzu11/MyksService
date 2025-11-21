<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\BadRequestException;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->Auth->allow(['login', 'logout', 'add','alert']);
    }

    public function isAuthorized($user)
    {
        if ($user['id_rol'] == 2) {

            // Permitir acceso solo a los métodos login, logout e index
            if (in_array($this->request->getParam('action'), ['login', 'eliminarAfiliado', 'logout', 'ajustes', 'afiliados', 'agendarcita', 'searchAfiliados', 'citas', 'panel'])) {
                return true;
            }

            // Bloquear acceso al método users/add
            if (
                $this->request->getParam('action') === 'add' || $this->request->getParam('action') === 'delete' || $this->request->getParam('action') === 'edit'
                || $this->request->getParam('action') === 'view' || $this->request->getParam('action') === 'index'
            ) {
                return false;
            }
        }

        // Permitir acceso por defecto para otros roles
        return true;
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        $user = $this->Auth->user();

        if ($user) {

            if ($user['id_rol'] === '1') {
                $this->Auth->allow();
            } else {
                if (!$this->isAuthorized($user)) {
                    $this->set('swalMessage', 'Estas intentando acceder a algo fuera de tus permisos, seras deslogeado');
                    $this->set('swalType', 'warning');
                    $this->viewBuilder()->Setlayout('error');
                    $this->render('/element/error');
                }
            }

        }
    }

    public function login($rol = null)
    {
        $this->set(compact("rol"));
        $this->viewBuilder()->Setlayout('login');
        $this->set('mensaje', 'noPost');

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                $data = $this->Auth->setUser($user);
                $rol = $user['id_rol'];

                if ($user['username'] == 'gerente' && $rol == 1) {
                    return $this->redirect(['controller' => 'users', 'action' => 'panel']);
                } elseif ($user['username'] == 'cajero' && $rol == 2) {
                    return $this->redirect(['controller' => 'users', 'action' => 'panel']);
                // } elseif ($user['username'] == 'carnicero' && $rol == 3) {
                //     return $this->redirect(['controller' => 'users', 'action' => 'panel']);
                } elseif ($user['username'] == 'admin' && $rol == 1) {
                    return $this->redirect(['controller' => 'users', 'action' => 'panel']);
                }

            }
            
            $this->set('mensaje', 'error1');
        }

    }

    public function panel()
    {
        $this->viewBuilder()->Setlayout('principal');
        $user = $this->Auth->user();
        $this->set(compact('user'));
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function index()
    {
        $this->viewBuilder()->Setlayout('medicos');

        $this->paginate = [
            'limit' => 5,
        ];

        $searchTerm = $this->request->getQuery('search');
        $filterStatus = $this->request->getQuery('status');

        if (empty($searchTerm) && empty($filterStatus)) {
            $users = 'null';
        } else {
            // Condición de búsqueda si se envia un término por search
            if (!empty($searchTerm)) {

                $this->paginate = [
                    'conditions' => [
                        'OR' => [
                            'Users.username' => $searchTerm,
                        ],
                    ],
                ];
            }

            // Condición de búsqueda si se envia un término el status
            if (!empty($filterStatus)) {
                $this->paginate['conditions'] = [
                    'status LIKE' => $filterStatus
                ];
            }
            $users = $this->paginate($this->Users);
        }

        $cantidadUsers = $this->Users->find('all')->count();

        $this->set(compact('cantidadUsers'));
        $this->set(compact('users'));
    }

    public function view($id = null)
    {
        $this->viewBuilder()->Setlayout('medicos');
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function add()
    {
        $this->viewBuilder()->Setlayout('principal');
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {

            if ($this->request->getData()['username']) {
                $existingUser = $this->Users->find('all', [
                    'conditions' => ['username' => $this->request->getData()['username']],
                ])->first();

                if ($existingUser) {
                    $respuesta = "Error";
                    $data = [
                        'respuesta' => $respuesta,
                        'link' => '../users/add',
                        'mensaje' => 'El usuario ya se encuentra registrado. Porfavor, ingresa otro nombre de usuario.'
                    ];

                    $url = [
                        'controller' => 'users',
                        'action' => 'alert',
                        '?' => $data
                    ];

                    return $this->redirect($url);
                }
            }

            $user = $this->Users->patchEntity($user, $this->request->getData());
            // debug($user);
            // die;
            if ($this->Users->save($user)) {
                $respuesta = "Correcto";
                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../users/panel',
                    'mensaje' => 'El usuario ha sido agregado exitosamente'
                ];

                $url = [
                    'controller' => 'users',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);
            } else {
                $respuesta = "Error";
                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../users/add',
                    'mensaje' => 'El usuario no se pudo agreagar. Porfavor, trata denuevo.'
                ];

                $url = [
                    'controller' => 'users',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);
            }
        }

        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        $this->viewBuilder()->Setlayout('medicos');
        $user = $this->Users->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->email = $this->request->getData()['email'];

            if ($this->Users->save($user)) {

                $respuesta = "Correcto";

                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../users',
                    'mensaje' => 'El usuario ha sido editado exitosamente.'
                ];

                $url = [
                    'controller' => 'users',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);
            }

            $respuesta = "Error";
            $data = [
                'respuesta' => $respuesta,
                'link' => '../users',
                'mensaje' => 'El usuario no se pudo editar. Porfavor, trata denuevo.'
            ];

            $url = [
                'controller' => 'users',
                'action' => 'alert',
                '?' => $data
            ];

            return $this->redirect($url);
        }

        $this->set(compact('user'));
    }

    public function alert()
    {
        $this->viewBuilder()->Setlayout('alert');
        $request = $this->getRequest();
        $respuesta = $request->getQuery('respuesta');
        $link = $request->getQuery('link');
        $mensaje = $request->getQuery('mensaje');

        $this->set(compact('respuesta'));
        $this->set(compact('link'));
        $this->set(compact('mensaje'));
    }

    public function ajustes()
    {
        $this->viewBuilder()->Setlayout('medicos');
        $user = $this->Auth->user();
        $the_user = $user['id'];
        $the_user_rol = $user['rol'];

        $this->set(compact('the_user', 'the_user_rol'));
        // $user = $this->Users->get($id);
        // $this->set(compact('user'));
    }

    public function actualizacion()
    {
        $this->viewBuilder()->Setlayout('actualizacion');
    }

    // public function verHistorialCitasSistema()
    // {
    //     $this->viewBuilder()->Setlayout('medicos');
    //     $this->loadModel("Afiliados");
    //     $this->loadModel("Medicos");
    //     $this->loadModel("Citas");

    //     $user = $this->Auth->user();
    //     // $currentUser = $this->Users
    //     // ->find()
    //     // ->where(['id' => $user['id']])->first()->toArray();


    //     $filterCorreo = $this->request->getQuery('search');
    //     $citas = 'null';
    //     $afiliados = 'null';
    //     $medicos = 'null';
    //     if (!empty($filterCorreo)) {

    //         $currentUser = $this->Users->find('all', [
    //             'conditions' => ['email' => $filterCorreo],
    //         ])->toArray();


    //         if (empty($currentUser)) {
    //             $respuesta = "Error";
    //             $data = [
    //                 'respuesta' => $respuesta,
    //                 'link' => '../users/verHistorialCitasSistema',
    //                 'mensaje' => 'El correo o nombre que ingreso no existe'
    //             ];

    //             $url = [
    //                 'controller' => 'users',
    //                 'action' => 'alert',
    //                 '?' => $data
    //             ];

    //             return $this->redirect($url);
    //         }

    //         $citas = $this->Citas
    //             ->find()
    //             ->where(['user_id' => $currentUser[0]['id'], 'fecha >' => date('m/d/y, h:i a')]);

    //         $medicos = $this->Medicos
    //             ->find()
    //             ->where(['status' => 'activo'])
    //             ->contain('Especialidades')->toArray();

    //         if (!empty($citas->toArray())) {
    //             $afiliados = $this->Afiliados->find('all', [
    //                 'conditions' => ['idUser' => $currentUser[0]['id']],
    //             ])->toArray();
    //         }
    //         $currentUser = $currentUser[0];
    //         $this->set(compact('currentUser'));
    //     }
    //     $this->set(compact('medicos'));
    //     $this->set(compact('citas'));
    //     $this->set(compact('afiliados'));
    // }

    // public function afiliados()
    // {
    //     $this->loadModel("Afiliados");
    //     $this->viewBuilder()->Setlayout('medicos');
    //     $afiliado = $this->Afiliados->newEmptyEntity();
    //     $this->set(compact('afiliado'));

    //     if ($this->request->is('post')) {

    //         if ($this->request->getData()['cedula']) {
    //             $existingUser = $this->Afiliados->find('all', [
    //                 'conditions' => ['cedula' => $this->request->getData()['tipo'] . '-' . $this->request->getData()['cedula']],
    //             ])->first();

    //             if ($existingUser) {
    //                 $respuesta = "Error";
    //                 $data = [
    //                     'respuesta' => $respuesta,
    //                     'link' => '../users/afiliados',
    //                     'mensaje' => 'El afiliado ya se encuentra registrado. Porfavor, ingresa otra cedula de afiliado.'
    //                 ];

    //                 $url = [
    //                     'controller' => 'users',
    //                     'action' => 'alert',
    //                     '?' => $data
    //                 ];

    //                 return $this->redirect($url);
    //             }
    //         }

    //         $afiliados = $this->Afiliados->patchEntity($afiliado, $this->request->getData());
    //         $afiliados->cedula = $this->request->getData()['tipo'] . '-' . $afiliados->cedula;

    //         if ($this->Afiliados->save($afiliados)) {
    //             $respuesta = "Correcto";
    //             $data = [
    //                 'respuesta' => $respuesta,
    //                 'link' => '../dashboard',
    //                 'mensaje' => 'El usuario ha sido agregado exitosamente'
    //             ];

    //             $url = [
    //                 'controller' => 'users',
    //                 'action' => 'alert',
    //                 '?' => $data
    //             ];

    //             return $this->redirect($url);
    //         } else {
    //             $respuesta = "Error";
    //             $data = [
    //                 'respuesta' => $respuesta,
    //                 'link' => '../users/afiliados',
    //                 'mensaje' => 'El afiliado no se pudo agregar. Porfavor, trata denuevo.'
    //             ];

    //             $url = [
    //                 'controller' => 'users',
    //                 'action' => 'alert',
    //                 '?' => $data
    //             ];

    //             return $this->redirect($url);
    //         }
    //     }
    //     $user = $this->Auth->user();
    //     $afiliado->idUser = $user['id'];
    //     $this->set(compact('afiliado'));
    // }

    // public function searchAfiliados($the_user, $the_user_rol)
    // {
    //     $this->loadModel("Afiliados");
    //     $this->viewBuilder()->setLayout('medicos');

    //     $user = $this->Auth->user();
    //     $idUser = $the_user;

    //     $afiliados = $this->Afiliados->find()
    //         ->where(['idUser' => $idUser])
    //         ->toArray();

    //     $afiliadosArray = [];
    //     foreach ($afiliados as $afiliado) {
    //         $afiliadosArray[] = [
    //             'id' => $afiliado->id,
    //             'nombre' => $afiliado->nombre,
    //             'apellido' => $afiliado->apellido,
    //             'fecha_nacimiento' => $afiliado->fecha_nacimiento,
    //             'cedula' => $afiliado->cedula,
    //             'email' => $afiliado->email

    //             // Agrega aquí los campos que quieras incluir en el array
    //         ];

    //     }

    //     $this->set(compact('afiliadosArray', 'the_user_rol'));
    // }


    public function delete($id = null)
    {
        $this->loadModel('Afiliados');
        $this->loadModel('Citas');
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $this->Citas->deleteAll(array('user_id' => $user->id));
        $this->Afiliados->deleteAll(array('idUser' => $user->id));


        if ($this->Users->delete($user)) {
            $respuesta = "Correcto";
            $data = [
                'respuesta' => $respuesta,
                'link' => '../users',
                'mensaje' => 'El usuario ha sido eliminado exitosamente'
            ];

            $url = [
                'controller' => 'users',
                'action' => 'alert',
                '?' => $data
            ];

            return $this->redirect($url);
        } else {
            $respuesta = "Error";
            $data = [
                'respuesta' => $respuesta,
                'link' => '../users',
                'mensaje' => 'El usuario no se pudo eliminar. Porfavor, trata denuevo.'
            ];

            $url = [
                'controller' => 'users',
                'action' => 'alert',
                '?' => $data
            ];

            return $this->redirect($url);
        }
    }

    public function editprofile()
    {
        $this->viewBuilder()->Setlayout('medicos');
        $the_user = $this->Auth->user();
        $id = $the_user['id'];
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->email = $this->request->getData()['email'];

            if ($this->Users->save($user)) {

                $respuesta = "Correcto";

                $data = [
                    'respuesta' => $respuesta,
                    'link' => '../dashboard',
                    'mensaje' => 'El usuario ha sido editado exitosamente.'
                ];

                $url = [
                    'controller' => 'users',
                    'action' => 'alert',
                    '?' => $data
                ];

                return $this->redirect($url);
            }

            $respuesta = "Error";
            $data = [
                'respuesta' => $respuesta,
                'link' => '../users/editprofile',
                'mensaje' => 'El usuario no se pudo editar. Porfavor, trata denuevo.'
            ];

            $url = [
                'controller' => 'users',
                'action' => 'alert',
                '?' => $data
            ];

            return $this->redirect($url);
        }

        $this->set(compact('user'));
    }

}