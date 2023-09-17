<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["user_id"])) {
    // Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("Location: users/login.php"); // Cambia "login.php" por la ruta de tu página de inicio de sesión.
    exit();
}

$type = 'profile';

?>

<?php include_once('../templates/header.php'); ?>

<main>

    <div class="download">
        <button>descargar CV</button>
    </div>

    <div class="resume">
        <div class="resume-left">
            <div class="resume-profile">
                <button type="button" class="btn-photo" onclick="openFileExplorer()">
                    <img id="photo-preview" src="assets/uploads/f99b5c118529a77eaa20d4d29b5cda2c.jpg" class="photo-preview">
                </button>
                <input type="file" id="photo" name="photo" accept="image/*" style="display: none;"
                    onchange="displayPhoto(event)">
            </div>
            <div class="resume-content">
                <div class="resume-item resume-info">
                    <div class="title">
                        <div class="icon-text">
                            <p class="bold editable">stephen colbert</p>
                            <i class="fas fa-pencil-alt"></i>
                        </div>
                        <div class="icon-text">
                            <p class="regular editable">Designer</p>
                            <i class="fas fa-pencil-alt"></i>
                        </div>
                    </div>
                    <ul>
                        <li>
                            <div class="icon">
                                <i class="fas fa-map-signs"></i>
                            </div>
                            <div class="data">
                                <div class="icon-text">
                                    <p class="editable with-icon">21 Street, Texas USA</p>
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="data">
                                <div class="icon-text">
                                    <p class="editable">+324 4445678</p>
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="data">
                                <div class="icon-text">
                                    <p class="editable">stephen@gmail.com</p>
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <i class="fab fa-weebly"></i>
                            </div>
                            <div class="data">
                                <div class="icon-text">
                                    <p class="editable">www.stephen.com</p>
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="resume-item resume-skills">
                    <div class="title custom-title">
                        <p class="bold">skill's</p>
                        <i class="fas fa-plus plus-white" onclick="addNewSkill('.resume-item.resume-skills ul')"></i>
                    </div>
                    <ul>
                        <li>
                            <div class="skill-name">
                                <div class="icon-text">
                                    <p class="editable">HTML</p>
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                            </div>
                            <div class="skill-progress">
                                <span style="width: 80%;"></span>
                            </div>
                            <div class="skill-per">
                                <div class="icon-text">
                                    <p class="editable">80%</p>
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="skill-name">
                                <div class="icon-text">
                                    <p class="editable">CSS</p>
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                            </div>
                            <div class="skill-progress">
                                <span style="width: 70%;"></span>
                            </div>
                            <div class="skill-per editable">
                                <div class="icon-text">
                                    <p class="editable">70%</p>
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="skill-name">
                                <div class="icon-text">
                                    <p class="editable">JS</p>
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                            </div>
                            <div class="skill-progress">
                                <span style="width: 60%;"></span>
                            </div>
                            <div class="skill-per editable">
                                <div class="icon-text">
                                    <p class="editable">60%</p>
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="resume-item resume-social">
                    <div class="title">
                        <p class="bold">Social</p>
                    </div>
                    <ul>
                        <li>
                            <div class="icon">
                                <i class="fab fa-facebook-square"></i>
                            </div>
                            <div class="data">
                                <p class="semi-bold">Facebook</p>
                                <div class="icon-text">
                                    <p class="editable">Stephen@facebook</p>
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <i class="fab fa-twitter-square"></i>
                            </div>
                            <div class="data">
                                <p class="semi-bold">Twitter</p>
                                <div class="icon-text">
                                    <p class="editable">Stephen@twitter</p>
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <i class="fab fa-linkedin"></i>
                            </div>
                            <div class="data">
                                <p class="semi-bold">Linkedin</p>
                                <div class="icon-text">
                                    <p class="editable">Stephen@linkedin</p>
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="resume-right">
            <div class="resume-item resume-about">
                <div class="title">
                    <p class="bold">About us</p>
                </div>
                <div class="icon-text">
                    <p class="editable">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perspiciatis illo fugit officiis distinctio culpa officia totam atque exercitationem inventore repudiandae?</p>
                    <i class="fas fa-pencil-alt"></i>
                </div>
            </div>
            <div class="resume-item resume-work">
                <div class="title custom-title">
                    <p class="bold">Work Experience</p>
                    <i class="fas fa-plus plus-blue" onclick="addNewElement('.resume-item.resume-work ul')"></i>
                </div>
                <ul>
                    <li>
                        <div class="date">
                            <div class="icon-text">
                                <p class="editable">2013- 2015</p>
                                <i class="fas fa-pencil-alt"></i>
                            </div>

                        </div>
                        <div class="info">
                            <div class="icon-text">
                                <p class="semi-bold editable">Lorem ipsum dolor sit amet.</p>
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                            <div class="icon-text">
                                <p class="editable">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus!</p>
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="date">
                            <div class="icon-text">
                                <p class="editable">2015 - 2017</p>
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <div class="info">
                            <div class="icon-text">
                                <p class="semi-bold editable">Lorem ipsum dolor sit amet.</p>
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                            <div class="icon-text">
                                <p class="editable">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus!</p>
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="date editable">
                            <div class="icon-text">
                                <p class="editable">2017 - Present</p>
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <div class="info">
                            <div class="icon-text">
                                <p class="semi-bold editable">Lorem ipsum dolor sit amet.</p>
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                            <div class="icon-text">
                                <p class="editable">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus!</p>
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="resume-item resume-education">
                <div class="title custom-title">
                    <p class="bold">Education</p>
                    <i class="fas fa-plus plus-blue" onclick="addNewElement('.resume-item.resume-education ul')"></i>
                </div>
                <ul>
                    <li>
                        <div class="date">
                            <div class="icon-text">
                                <p class="editable">2010- 2013</p>
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <div class="info">
                            <div class="icon-text">
                                <p class="semi-bold editable">Web Designing (Texas University)</p>
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                            <div class="icon-text">
                                <p class="editable">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum,voluptatibus!</p>
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="date editable">
                            <div class="icon-text">
                                <p class="editable">2000 - 2010</p>
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <div class="info">
                            <div class="icon-text">
                                <p class="semi-bold editable">Texas International School</p>
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                            <div class="icon-text">
                                <p class="editable">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus!</p>
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
            <!-- <div class="resume-item resume-hobby">
                <div class="title">
                    <p class="bold">Hobby</p>
                </div>
                <ul>
                    <li><i class="fas fa-book"></i></li>
                    <li><i class="fas fa-gamepad"></i></li>
                    <li><i class="fas fa-music"></i></li>
                    <li><i class="fab fa-pagelines"></i></li>
                </ul>
            </div> -->
        </div>
    </div>

</main>

<?php include "../templates/footer.php"; ?>
