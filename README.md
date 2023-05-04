SYMFONY EXAMPLES : doctrine fixtures
====================================

# About this repository

This is an simple implementation of doctrine fixtures.

# How to test

This repo contains a makefile with commands shortcuts for docker and podman.

```sh
# Build container
make build

# Enter inside the php container
make run

# Install project dependancies
make install

# Execute php-cs-fixer
make fix

# Execute phpstan
make phpstan

# Execute unit tests
make unit

# Run all tests
make check-all
```

# About examples

## Handle multiple environments.

There are multiple ways to handle multiple environments with doctrine fixtures. This example is based on using groups and assigning the 
right groups to fixtures depending on the environment. The group assignation are set inside an abstract class for each envs. See :

- App\DataFixtures\Test\AbstractTestFixtures
- App\DataFixtures\Test\AbstractDevFixtures

Available environments are centralized inside App\DataFixtures\AppEnvFixtures.
For this example, two environments are set : Dev and Test.

## Simple entity example

This exemple is the simpliest one. It only concerns a single entity without any dependancies.

See example : 
- App\DataFixtures\Test\SimpleEntityFixtures
- App\DataFixtures\Dev\SimpleEntityFixtures

## Shared entities example

This example show how to share a given entity from a fixture to another fixture by reference.
To share an entity :

- Create the parent fixture and add a constant inside it.
- Create the entity to share.
- Push the created entity as a reference inside the constant.
- Create child entity fixtures.
- Call the reference inside child entity.

See example :
- App\DataFixtures\Test\SharedEntityParentFixtures
- App\DataFixtures\Test\SharedEntityChildrenFixtures

It's also possible to manage shared fixtures inside a single file :
- App\DataFixtures\Dev\SharedEntityFixtures

## Multiple entities example

This example show how to create entity with multiple references.
To share entities :

- Create the parent fixture with multiple entity.
- Create child entity fixtures.
- Call the parent entity repository inside child fixtures.

See examples :
- App\DataFixtures\Test\MultiReferenceEntityChildrenFixtures
- App\DataFixtures\Test\MultiReferenceParentFixtures

It's also possible to do it inside a single file :
- App\DataFixtures\Dev\MultiReferenceEntityFixtures

# Need another example

If another example is needed please open a PR describing the need.

# Usefull documentation

- [Doctrine fixture bundle documentation](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html)
- [DoctrineFixturesBundle github repository](https://github.com/doctrine/DoctrineFixturesBundle)
