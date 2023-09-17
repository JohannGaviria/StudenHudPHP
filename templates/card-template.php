<div class="card-container">
    <div class="card">
        <?php if ($job_offer['is_new_job']): ?>
        <div class="new-indicator">Nuevo</div>
        <?php endif; ?>
        <div class="inner-card">
            <div class="front-card">
                <div class="content-top">
                    <img src="assets/uploads/img/jobs-img/<?php echo $job_offer['img']; ?>" alt="<?php echo $job_offer['title']; ?>">
                    <h2 class="title"><?php echo $job_offer['title']; ?></h2>
                    <p class="company"><?php echo $job_offer['company']; ?></p>
                    <h3 class="subtitle-section">Fecha de Publicación y Expiración</h3>
                    <p class="publication-date"><?php echo $job_offer['publication_date']; ?></p>
                    <p class="expiration-date"><?php echo $job_offer['expiration_date']; ?></p>
                </div>
                <div class="content">
                    <h3 class="subtitle">Ubicación</h3>
                    <p><?php echo $job_offer['location']; ?></p>
                    <h3 class="subtitle">Tipo de Contrato</h3>
                    <p><?php echo $job_offer['contract_type']; ?></p>
                </div>
                <div class="content-footer">
                    <h4 class="salary"><?php echo $job_offer['salary']; ?></h4>
                </div>
            </div>

            <div class="back-card">
                <div class="content">
                    <h3 class="subtitle" style="font-size: 34px;">Descripción</h3>
                    <p class="description" style="font-size: 20px;"><?php echo $job_offer['description']; ?></p>
                    <h3 class="subtitle" style="font-size: 34px;">Requisitos</h3>
                    <p class="requirement" style="font-size: 20px;"><?php echo $job_offer['requirements']; ?></p>
                    <?php if ($job_offer['file']): ?>
                    <a href="#" download="<?php echo $job_offer['file']; ?>" class="file">Descargar Archivo PDF</a>
                    <?php endif; ?>
                </div>
                <div class="content-footer">
                    <button>Aplicar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="social-bar">
        <?php if ($job_offer['contact_email']): ?>
        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $job_offer['contact_email']; ?>" target="_blank" title="<?php echo $job_offer['contact_email']; ?>"><i class="fas fa-envelope"></i></a>
        <?php endif; ?>
    
        <?php if ($job_offer['contact_phone']): ?>
        <a href="https://wa.me/+57<?php echo $job_offer['contact_phone']; ?>" target="_blank" title="+57 <?php echo $job_offer['contact_phone']; ?>"><i class="fab fa-whatsapp"></i></a>
        <?php endif; ?>
    
        <?php if ($job_offer['contact_linkedin']): ?>
        <a href="<?php echo $job_offer['contact_linkedin']; ?>" target="_blank" title="<?php echo $job_offer['contact_linkedin']; ?>"><i class="fab fa-linkedin"></i></a>
        <?php endif; ?>
    </div>
</div>
