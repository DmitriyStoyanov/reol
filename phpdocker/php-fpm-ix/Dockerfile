FROM php:8-fpm-alpine
WORKDIR "/application"



RUN apk add --update \
		$PHPIZE_DEPS \
		ffmpeg \
		freetype-dev \
		libjpeg-turbo-dev \
		libpng-dev \
		libxml2-dev \
		libzip-dev \
		openssh-client \
		djvulibre \
		poppler-utils \
		libdjvulibre \
		imagemagick \
		imagemagick-libs \
		imagemagick-dev \
		php8-pecl-imagick \
		php8-pcntl \
		php8-zip \
	&& docker-php-ext-install sockets exif pcntl \
	&& docker-php-ext-configure gd --with-jpeg --with-freetype \
	&& docker-php-ext-install gd \
	&& docker-php-ext-install zip

RUN printf "\n" | pecl install \
		imagick && \
		docker-php-ext-enable --ini-name 20-imagick.ini imagick


ARG imagemagic_config=/etc/ImageMagick-6/policy.xml

RUN if [ -f $imagemagic_config ] ; then sed -i 's/<policy domain="coder" rights="none" pattern="PDF" \/>/<policy domain="coder" rights="read|write" pattern="PDF" \/>/g' $imagemagic_config ; else echo did not see file $imagemagic_config ; fi
RUN if [ -f $imagemagic_config ] ; then sed -i 's/<policy domain="coder" rights="none" pattern="PS" \/>/<policy domain="coder" rights="read|write" pattern="PS" \/>/g' $imagemagic_config ; else echo did not see file $imagemagic_config ; fi

