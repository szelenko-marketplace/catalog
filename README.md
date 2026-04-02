# Catalog Microservice

This is the Catalog microservice for the Marketplace project. It is built using **Symfony** and is designed to run within a Kubernetes cluster.

## Features
* **Product Management**: Core logic for handling catalog items.
* **Optimized Caching**: Uses Redis as a cache adapter for high performance.
* **Cloud Native**: Fully containerized and ready for deployment via Helm.

## Technical Stack
* **PHP 8.x** (Symfony Framework)
* **Redis**: Primary cache provider.
* **Kubernetes/MicroK8s**: Target runtime environment.

## Maintain
### Enter container
```shell
kubectl exec -it deployment/catalog -c php -- bash
```
### Migrate
```shell
kubectl exec -it deployment/catalog -c php -- php bin/console doctrine:migrations:migrate -n
```
### Clear cache
```shell
kubectl exec -it deployment/catalog -c php -- php bin/console c:c
```
### Composer install
```shell
kubectl exec -it deployment/catalog -c php -- composer i -o
```
### Run phpunit
```shell
kubectl exec -it deployment/catalog -c php -- bin/phpunit
```

## Install Chart
### Build image 
```shell
docker build -t localhost:32000/catalog:latest ./kube
```
### Build xdebug image  
```shell
docker build --build-arg INSTALL_XDEBUG=1 -t localhost:32000/catalog:latest ./kube
```
### Push to local registry
```shell
docker push localhost:32000/catalog:latest
```
### Copy values.yaml.dist to values.yaml 
```shell
cp values.yaml.dist values.yaml
```
### Update project hostPath in values.yaml

### Install service
```shell
helm install catalog ./kube/chart/ -f values.yaml
```

### Update service
```shell
helm upgrade catalog ./kube/chart/ -f values.yaml
```

### Uninstall service
```shell
helm uninstall catalog
```
### Add hostname
```shell
echo "127.0.0.1 catalog.local" | sudo tee -a /etc/hosts > /dev/null
```
